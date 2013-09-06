<?php
require('../Log/LogInterface.php');
require('../Log/Backend/BaseBackend.php');
require('../Log/Backend/ArrayBackend.php');

use \Log\Backend\ArrayBackend;


class ArrayBackendTest extends PHPUnit_Framework_TestCase {
	var $logger;
	
	public function setUp() {		
		$this->logger = new ArrayBackend();
	}

	public function tearDown() {
		unset($this->logger);
	}

	public function testExists(){
		$this->assertNotEmpty($this->logger, 'Logger doesn\'t exist!');
		$this->assertInstanceOf('\Log\LogInterface', $this->logger, 'Does not have proper interface!');
		$this->assertInstanceOf('\Log\Backend\ArrayBackend', $this->logger, 'Isn\'t the right class!');
	}

	public function testCanLog(){
		$message = 'This is a log message';
		$this->assertEmpty($this->logger->logs, 'Logs did not start out empty as expected!');
		$this->logger->log($message);
		$this->assertNotEmpty($this->logger->logs, 'Logs were still empty after tyring to log!');
		$this->assertEquals($message, $this->logger->logs[0]->message, 'Log did not contain what it was supposed to!');
	}

	public function testCanToggleLogging(){
		$this->assertEmpty($this->logger->logs, 'Logs did not start out empty as expected!');
		$this->logger->disableLogging(true);
		$this->logger->log('This is a log message');
		$this->assertEmpty($this->logger->logs, 'Logs did not stay empty after disabling logging!');
		$this->logger->disableLogging(false);
		$this->logger->log('This is a log message');
		$this->assertNotEmpty($this->logger->logs, 'Logs were still empty after enabling logging!');
	}	
}
?>