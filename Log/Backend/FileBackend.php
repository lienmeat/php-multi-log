<?php namespace Log\Backend;

use \Log\Backend\BaseBackend;

class FileBackend extends BaseBackend {
	/**
	* Path to a file to log to
	* @var string
	* @access private
	*/
	private $file;
	
	/**
	* File handle to use
	* @var resource
	* @access private
	*/
	private $fh;

	/**
	* @param string $filepath Path to file to log to
	*/
	function __construct($filepath) {
		$this->openFile($filepath);
		$this->log("******** LOGGER INITIALIZED IN {$_SERVER['PHP_SELF']} *********");
	}
	
	/** 
	* Opens a file for appending and creates file handle $fh
	* @param string $filepath
	*/
	private function openFile($filepath) {
		if(!$this->fh = fopen($filepath, 'a')) { 
			throw new Exception("Could not open file \"$filepath\" for appending!");
		}
		$this->file = $filepath;
	}

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
			$timestamp = date("M d H:i:s");
			$output = "$timestamp [{$_SERVER['PHP_SELF']}] $message\n";
			@fwrite($this->fh, $output);
			return $output;
		}
	}	
	
	/**
	* Close file handle when object dies
	*/
	function __destruct() {
		@fclose($this->fh);
	}
}
?>