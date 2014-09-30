<?php

namespace Gourmet\Dashboard\View\Exception;

use Cake\Core\Exception\Exception;

class MissingDashboardException extends Exception {

	protected $_messageTemplate = 'Dashboard file "%s" is missing.';

}
