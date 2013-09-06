<?php namespace Log;

interface LogInterface {
	/**
	* Log a message, optionally with extra data
	* @param string $message
	* @param array|object $data (optional)
	* @return string $message
	* @access public
	*/
	public function log($message, $data=null);

	/**
	*	Set whether logging is disabled
	* @param boolean $disabled
	* @access public
	*/
	public function disableLogging($disabled=true);
}
?>