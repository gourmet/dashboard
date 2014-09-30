<?php

namespace Gourmet\Dashboard\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Cake\Filesystem\Folder;
use Gourmet\Dashboard\Core\DashboardWidget;

class DashboardController extends AppController {

/**
 * {@inheritdoc}
 */
	public $autoRender = false;

/**
 * {@inheritdoc}
 */
	public $layout = 'Gourmet/Dashboard.default';

/**
 * {@inheritdoc}
 */
	public $viewClass = 'Gourmet\Dashboard\View\View';

/**
 * Serve Html templates to batman.
 *
 * @return void
 */
	public function views($id) {
		$this->autoLayout = false;
		foreach (DashboardWidget::paths() as $path) {
			$path .= Inflector::classify($id) . DS . 'view.ctp';
			if (!file_exists($path)) {
				continue;
			}

			echo file_get_contents($path);
			exit();
		}
	}

/**
 * Display dashboard defined by creating a cake template file,
 *
 *   Example: status.ctp would route to /dashboard/status
 *
 * @return void
 */
	public function index() {
		if (!$this->request->is('get')) {
			throw new NotFoundException();
		}

		$dashboard = __FUNCTION__;
		if (!empty($this->request->params['dashboard'])) {
			$dashboard = $this->request->params['dashboard'];
		}

		$this->render($dashboard);
	}

/**
 * Event stream.
 *
 * @return void
 */
	public function events() {
		$this->autoLayout = false;
		header('Content-Type: text/event-stream');
		header('Cache-Control: no-cache');
		ini_set('output_buffering', 'off');
		ini_set('zlib.output_compression', false);
		ini_set('implicit_flush', true);
		ob_implicit_flush(true);

		if (function_exists('apache_setenv')) {
			apache_setenv('no-gzip', '1');
			apache_setenv('dont-vary', '1');
		}

		foreach (DashboardWidget::widgets() as $widget => $path) {
			$listener = $widget  . 'WidgetWorker';
			$path .= 'worker.php';

			if (!file_exists($path)) {
				continue;
			}

			require $path;
			$this->eventManager()->attach(new $listener);
		}

		$events = TableRegistry::get('Gourmet/Dashboard.Events');
		while (true) {
			$this->dispatchEvent('Dashboard.beforePoll');

			$ids = [];
			foreach ($events->stream() as $event) {
				echo $event->content . "\n\n";
				$ids[] = $event->id;
			}
			$events->updateAll(['view_cnt = view_cnt + 1'], ['id IN' => $ids]);

			flush();
			sleep(1);
		}
	}

/**
 * Endpoint for POST-ing to event stream.
 *
 * @return void
 */
	public function update($id) {
		if (empty($this->request->params['dtype'])) {
			throw new NotFoundException();
		}

		$this->response->statusCode(204);
		TableRegistry::get('Gourmet/Dashboard.Events')->push($id, $this->request->data());
	}

}
