<?php

use Cake\Event\Event;
use Gourmet\Dashboard\DashboardWidget\AbstractWidgetWorker;

class ConvergenceWidgetWorker extends AbstractWidgetWorker {

	public $lastX = 0;

	public function __construct() {
		parent::__construct();
		$this->points = [];
		for ($i = 0; $i < 10; $i++) {
			$this->points[] = ['x' => $i, 'y' => rand(0, 50)];
		}
		$this->lastX = $i;
	}

	public function beforePoll(Event $event) {
		if (!$this->interval(2)) {
			return;
		}

		array_shift($this->points);
		$this->lastX++;
		$this->points[] = ['x' => $this->lastX, 'y' => rand(0, 50)];
		$this->push(['points' => $this->points]);
	}

}
