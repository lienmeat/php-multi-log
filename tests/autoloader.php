<?php
function __autoload($class) {
	$class = str_replace('\\', '/', $class) . '.php';
	die("class: ".$class);
	require_once("../".$class);
}
?>