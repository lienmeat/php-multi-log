<?php namespace Log\Backend;

use \Log\LogInterface;

abstract class BaseBackend implements LogInterface {
	
	/**
	* Whether to write
	* @var boolean
	* @access protected
	*/
	protected $do_write = true;
	
	/**
	*	Log a message and data
	* @param string $message
	* @param array|object|null $data
	* @return string $message
	* @access public
	*/
	public function log($message, $data=null) {
		//stub: you need to override this!
		return $message;
	}

	/**
	*	Turn off/on logging
	* @param boolean $disabled	
	* @access public
	*/
	public function disableLogging($disabled=true) {
		if($disabled) {
			$this->do_write = false;
		}elseif($disabled === false) {
			$this->do_write = true;
		} 
	}
}
?>