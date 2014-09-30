<?php

use Cake\Event\Event;
use Gourmet\Dashboard\DashboardWidget\AbstractWidgetWorker;

class KarmaWidgetWorker extends AbstractWidgetWorker {

	public $currentValuation = 0;
	public $currentKarma = 0;

	public function beforePoll(Event $event) {
		if (!$this->interval(8)) {
			return;
		}

		$last_valuation = $this->currentValuation;
		$last_karma = $this->currentKarma;

		$this->currentValuation = rand(0, 100);
		$this->currentKarma = rand(0, 200000);

		$this->push(['current' => $this->currentKarma, 'last' => $last_karma]);
		$this->push(['current' => $this->currentValuation, 'last' => $last_valuation], 'valuation');
		$this->push(['value' => rand(0, 100)], 'synergy');
	}

}
