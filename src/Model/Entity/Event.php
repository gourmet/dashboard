<?php

namespace Gourmet\Dashboard\Model\Entity;

use Cake\ORM\Entity;

class Event extends Entity {

	protected function _getContent() {
		return 'data: ' . json_encode([
			'id' => $this->_properties['widget'],
			'updatedAt' => $this->_properties['scraped']->getTimestamp()
		] + $this->_properties['data']);
	}

}
