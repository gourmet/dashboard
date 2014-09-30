<?php

namespace Gourmet\Dashboard\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class EventFixture extends TestFixture {

	public $fields = [
		'id' => ['type' => 'uuid'],
		'widget' => ['type' => 'string'], // if null, then it's 'dashboards'
		'data' => ['type' => 'string', 'null' => false], // json_encode()'d event data to pass to widget
		'view_cnt' => ['type' => 'integer', 'default' => 0], // count views, 0 for new events
		'created' => ['type' => 'string'], // used for the `updatedAt` passed to widget and to check the last run
		'_constraints' => [
			'primary' => ['type' => 'primary', 'columns' => ['id']]
		]
	];

}
