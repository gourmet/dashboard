<?php

namespace Gourmet\Dashboard\Model\Entity;

use Cake\ORM\Entity;

class Event extends Entity {

	protected function _getContent() {
		return 'data: ' . json_encode([
			'id' => $this->_properties['widget'],
			// 'updatedAt' => $this->_properties['created']->getTimestamp()
			'updatedAt' => $this->last_run
		] + $this->_properties['data']);
	}

	protected function _getLastRun() {
		preg_match_all('/([\d]{4})([\d]{2})([\d]{2})([\d]{2})([\d]{2})([\d]{2})/', $this->_properties['created'], $matches);
		return strtotime(sprintf(
			'%s-%s-%s %s:%s:%s'
			, $matches[1][0]
			, $matches[2][0]
			, $matches[3][0]
			, $matches[4][0]
			, $matches[5][0]
			, $matches[6][0]
		));
	}

}
