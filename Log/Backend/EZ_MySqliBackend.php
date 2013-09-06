<?php namespace Log\Backend;

use \Log\Backend\BaseBackend;

class EZ_MySqliBackend extends BaseBackend {

	/**
	* Database connection
	*	@var EZ_MySqli
	* @access private
	*/
	private $db;
	
	/**
	* Table schema:
	* id (varchar length 23, primary key)
	* timestamp (timestamp)
	* message (text)
	* @var string
	* @access private
	*/
	private $table;	
	
	/**
	*	You must already have a database connection to give this backend on instantiation!
	* @param EZ_MySqli $EZ_MySqli_db
	* @param string $table
	* @param boolean $disabled
	*/
	function __construct(EZ_MySqli $EZ_MySqli_db, $table, $disabled=false) {
		if(!$EZ_Mysqli_db || !$table) {
			return;
		}		
		$this->table = $table;
		$this->db = $EZ_Mysqli_db;
		if($disabled) {
			$this->disableLogging();
		}
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
		$id = uniqid('',true);
		$timestamp = date("Y-m-d H:i:s");
		if($this->do_write) {
			$this->db->insert($this->table, array('id'=>$id, 'message'=>$message, 'timestamp'=>$timestamp));
			return $message;
		}
	}	
}
?>