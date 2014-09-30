<?php

namespace Gourmet\Dashboard\View;

use Cake\View\View as CakeView;
use Cake\View\Exception\MissingViewException;

class View extends CakeView {

/**
 * Returns filename of given action's template file (.ctp) as a string.
 * CamelCased action names will be under_scored! This means that you can have
 * LongActionNames that refer to long_action_names.ctp views.
 *
 * @param string $name Controller action to find template filename for
 * @return string Template filename
 * @throws \Cake\View\Exception\MissingViewException when a view file could not be found.
 */
	protected function _getViewFileName($name = null) {
		try {
			$result = parent::_getViewFileName($name);
		} catch (MissingViewException $e) {
			throw new Exception\MissingDashboardException($e->getMessage());
		}

		return $result;
	}

}
