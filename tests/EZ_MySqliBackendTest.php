<?php
require('EZ_MySqli.php');
require('../Log/LogInterface.php');
require('../Log/Backend/BaseBackend.php');
require('../Log/Backend/EZ_MySqliBackend.php');

use \Log\Backend\EZ_MySqliBackend;


class EZ_MySqliBackendTest extends PHPUnit_Framework_TestCase {
	var $logger;
	
	public function setUp() {
		$db = new \EZ_MySqli('logtest', 'localhost', 'logtestuser', 'logtestpass');
		$this->logger = new EZ_MySqliBackend($db, 'logs');
	}

	public function tearDown() {
		unset($this->logger);
	}

	public function testExists(){
		$this->assertNotEmpty($this->logger, 'Logger doesn\'t exist!');
		$this->assertInstanceOf('\Log\LogInterface', $this->logger, 'Does not have proper interface!');
		$this->assertInstanceOf('\Log\Backend\EZ_MySqliBackend', $this->logger, 'Isn\'t the right class!');
	}

	public function testCanLog(){
		$message = 'This is a log message';
		$log = $this->logger->log($message);		
		$this->assertNotEmpty($log, 'Logs were still empty after tyring to log!');
		$this->assertContains($message, $log, 'Log did not contain what it was supposed to!');
	}

	public function testCanToggleLogging(){
		$message = 'This is a log message';
		$this->logger->disableLogging(true);
		$log = $this->logger->log($message);
		$this->assertEmpty($log, 'Log had a message and shouldn\'t have afer being disabled!');
		$this->logger->disableLogging(false);
		$log = $this->logger->log($message);
		$this->assertContains($message, $log, 'Log did not have a message containing what it should have!');
	}
}
?>