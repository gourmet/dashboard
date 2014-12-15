<?php

namespace Gourmet\Dashboard\TestSuite;

class WidgetWorkerTestCase extends \PHPUnit_Framework_TestCase {

/**
 * Widget's name (i.e. Buzzwords)
 *
 * @var string
 */
	protected $_name;

/**
 * Get mocked instance of current widget
 *
 * @param array $methods
 * @return
 */
	protected function _getWidgetWorkerMock(array $methods = []) {
		return $this->getMock('\\' . $this->_name . 'WidgetWorker', array_merge(['_getEvents'], $methods));
	}

/**
 * Return mocked instance with basic expectations pre-defined
 *
 * @param array $data
 * @param string $id
 * @return
 */
	protected function _getWidgetWorkerExpectingPush($data, $id = null) {
		$worker = $this->_getWidgetWorkerMock(['interval', 'push']);

		$worker->expects($this->once())
			->method('interval')
			->with($this->anything())
			->will($this->returnValue(true));

		$worker->expects($this->once())
			->method('push')
			->with($data, $id);

		return $worker;
	}

}
