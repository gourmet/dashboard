<?php

use Cake\Routing\Router;

/**
 * Routes configuration.
 */
	Router::plugin('Gourmet/Dashboard', function($routes) {
		$routes->extensions(['html']);

		$routes->connect('/events', [
			'plugin' => 'Gourmet/Dashboard',
			'controller' => 'Dashboard',
			'action' => 'events',
		]);

		$routes->connect('/views/*', [
			'plugin' => 'Gourmet/Dashboard',
			'controller' => 'Dashboard',
			'action' => 'views',
		]);

		$routes->connect('/push/:dtype/*', [
			'plugin' => 'Gourmet/Dashboard',
			'controller' => 'Dashboard',
			'action' => 'update',
		], ['dtype' => '[a-z]+']);

		$routes->connect('/:dashboard', [
			'plugin' => 'Gourmet/Dashboard',
			'controller' => 'Dashboard',
			'action' => 'index',
		], ['dashboard' => '[a-z0-9]+']);

	});
