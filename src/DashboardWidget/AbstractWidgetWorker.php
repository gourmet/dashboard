<?php

namespace Gourmet\Dashboard\DashboardWidget;

use Cake\Event\Event;
use Cake\Event\EventListener;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Gourmet\Dashboard\Cache\Cache;
use Gourmet\Dashboard\Lib\Dashboard;

abstract class AbstractWidgetWorker implements EventListener {

/**
 * Widget's ID
 *
 * @var string
 */
	protected $_id;

	protected $_events;

/**
 * Constructor
 *
 * @return void
 */
	public function __construct() {
		$this->_id = Inflector::underscore(str_replace('WidgetWorker', '', get_class($this)));
		$this->_events = $this->_getEvents();
	}

/**
 * {@inheritdoc}
 */
	public function implementedEvents() {
		return ['Dashboard.beforePoll' => 'beforePoll'];
	}

/**
 * Push to event stream.
 *
 * @return void
 */
	public function push($data, $id = null, $scraped = null) {
		if (empty($id)) {
			$id = $this->_id;
		}

		$this->_events->push($id, $data, $scraped);
	}

/**
 * Is it the first run or has it been $secs since last run?
 *
 * @return boolean
 */
	public function interval($secs) {
		$event = $this->_events->find('recent')->where(['widget' => $this->_id])->first();
		if ($event && (time() - $event['last_run']) < $secs) {
			$this->push($event['data'], $this->_id, $event['last_run']);
			return false;
		}
		return true;
	}

/**
 * Callback
 *
 * @return void
 */
	public function beforePoll(Event $event) {}

/**
 * Separate for easier testing.
 *
 * @return \Cake\ORM\Table
 */
	protected function _getEvents() {
		return TableRegistry::get('Gourmet/Dashboard.Events');
	}

}
