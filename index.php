<?php

use \Log\Backend as LogBackend;
use \Log\Service\LogService;

$log = new LogService(new LogBackend\ArrayBackend());

$log->log('message1', array('somekey'=>'somedata'));

echo "<pre>".print_r($log->getBackend()->logs, true)."</pre>";

/**
* Basic autoloader so we can make use of our fancy namespaces
*/
function __autoload($class) {
	$class = str_replace('\\', '/', $class) . '.php';
	require_once($class);
}
?>