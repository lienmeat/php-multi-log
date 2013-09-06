<?php namespace Log\Backend;

use \Log\Backend\BaseBackend;

class ArrayBackend extends BaseBackend {	
	
	/**
	*	@var array
	* @access public
	*/
	var $logs = array();	
	
	/**
	*	Log a message and data
	* @param string $message
	* @param array|object|null $data
	* @return string
	* @access public
	*/
	public function log($message, $data=null) {
		if(is_array($data) || is_object($data)) {
			$message.=" ".print_r($data, true);
		}

		if($this->do_write) {
			$entry = new \stdClass();
			$entry->timestamp = date("Y-m-d H:i:s");
			$entry->message = $message;
			$this->logs[] = $entry;
			return $message;
		}
	}
}
?>