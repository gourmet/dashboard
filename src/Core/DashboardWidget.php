<?php

namespace Gourmet\Dashboard\Core;

use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Filesystem\Folder;

class DashboardWidget {

	protected static $_paths = [];
	protected static $_widgets = [];

	public static function paths() {
		if (empty(self::$_paths)) {
			$path = 'DashboardWidget' . DS;
			self::$_paths[] = APP . $path;

			foreach (Plugin::loaded() as $plugin) {
				// skip, to force inclusion at end of array
				if ('Gourmet/Dashboard' == $plugin) {
					continue;
				}

				self::$_paths[] = Plugin::path($plugin) . 'src' . DS . $path;
			}

			self::$_paths[] = Plugin::path('Gourmet/Dashboard') . 'src' . DS . $path;
		}

		return self::$_paths;
	}

	public static function widgets() {
		if (!empty(self::$_widgets)) {
			return self::$_widgets;
		}

		foreach (self::paths() as $path) {
			if (!is_dir($path)) {
				continue;
			}

			$folder = new Folder($path);
			list($widgets) = $folder->read();
			foreach ($widgets as $widget) {
				self::$_widgets[$widget] = $path . $widget . DS;
			}
		}

		return self::$_widgets;
	}
}
