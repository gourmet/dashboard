<?php

use Cake\Event\Event;
use Gourmet\Dashboard\DashboardWidget\AbstractWidgetWorker;

class BuzzwordsWidgetWorker extends AbstractWidgetWorker {

	public $buzzwords = [
		'Paradigm shift',
		'Leverage',
		'Pivoting',
		'Turn-key',
		'Streamlininess',
		'Exit strategy',
		'Synergy',
		'Enterprise',
		'Web 2.0'
	];

	public $count = [];

	public function __construct() {
		parent::__construct();
		array_map(function ($i) {
			$this->count[$i] = ['label' => $i, 'value' => rand(1234, 5678)];
		}, $this->buzzwords);
	}

	public function beforePoll(Event $event) {
		if (!$this->interval(10)) {
			return;
		}

		$buzzword = $this->buzzwords[array_rand($this->buzzwords)];
		$this->count[$buzzword] = ['label' => $buzzword, 'value' => ($this->count[$buzzword]['value'] + rand(1, 10))];
		$this->push(['items' => array_values($this->count)]);
	}

}
