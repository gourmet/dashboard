<?php

use Cake\Datasource\ConnectionManager;

/**
 * Load configuration for
 */
	if (php_sapi_name() === 'cli') {
		return;
	}

/**
 * Database connection. Defaults to SQLite.
 */
	if (!ConnectionManager::config('gourmet_dashboard')) {
		ConnectionManager::config('gourmet_dashboard', [
			'className' => 'Cake\Database\Connection',
			'driver' => 'Cake\Database\Driver\Sqlite',
			'database' => TMP . 'gourmet_dashboard.sqlite',
			'encoding' => 'utf8',
			'cacheMetadata' => true,
			'quoteIdentifiers' => false,
		]);
	}
