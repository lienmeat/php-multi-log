<?php namespace Log\Service;

use \Log\LogInterface;

class LogService implements LogInterface {
	
	/**
	*	Backend to use to log
	* @var \Log\LogInterface
	* @access private
	*/
	private $backend;
	
	/**
	* @param \Log\LogInterface $backend Optionally set up the log backend on service creation
	*/
	public function __construct(LogInterface $backend=null) {
		if($backend) {
			$this->setBackend($backend);
		}
	}

	/**
	* Switch out logger backend with another
	* @param \Log\LogInterface $backend Object implementing LogInterface
	* @access public
	*/
	public function setBackend(LogInterface $backend) {
		$this->backend = $backend;
	}

	/**
	* Get a copy of the backend being used
	* @access public
	* @return LogInterface	
	*/
	public function getBackend() {
		return $this->backend;
	}
	
	/**
	*	Log a message and data using the registered backend
	* @param string $message
	* @param array|object|null $data
	* @return string
	* @access public
	*/
	public function log($message, $data=null) {		
		return $this->backend->log($message, $data);
	}
	
	/**
	*	Turn off/on logging
	* @param boolean $disabled	
	* @access public
	*/
	public function disableLogging($disabled=true) {
		$this->backend->disableLogging($disabled);
	}	
}

?>