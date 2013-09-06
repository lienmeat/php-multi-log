<?php
require('../Log/LogInterface.php');
require('../Log/Service/LogService.php');
require('../Log/Backend/BaseBackend.php');
require('../Log/Backend/ArrayBackend.php');
require('../Log/Backend/FileBackend.php');

use \Log\Service\LogService;
use \Log\Backend\ArrayBackend;
use \Log\Backend\FileBackend;

class LogServiceTest extends PHPUnit_Framework_TestCase {
	var $logger_service;
	
	public function setUp() {		
		$this->logger_service = new LogService(new ArrayBackend());
	}

	public function tearDown() {
		unset($this->logger_service);
	}

	public function testHasBackend(){
		$this->assertInstanceOf('\Log\LogInterface', $this->logger_service->getBackend(), 'Does not have proper backend!');
		$this->assertInstanceOf('\Log\Backend\ArrayBackend', $this->logger_service->getBackend(), 'Does not have proper backend!');
	}

	public function testCanSwitchBackend(){		
		$this->logger_service->setBackend(new FileBackend('somefile.txt'));
		$this->assertInstanceOf('\Log\Backend\FileBackend', $this->logger_service->getBackend(), 'Cannot switch backends!');
		$this->logger_service->setBackend(new ArrayBackend());
		$this->assertInstanceOf('\Log\Backend\ArrayBackend', $this->logger_service->getBackend(), 'Cannot switch backends!');
	}

	public function testCanLog(){
		$this->assertEmpty($this->logger_service->getBackend()->logs, 'Logs did not start out empty as expected!');
		$this->logger_service->log('This is a log message');
		$this->assertNotEmpty($this->logger_service->getBackend()->logs, 'Logs were still empty after tyring to log!');		
	}

	public function testCanToggleLogging(){
		$this->assertEmpty($this->logger_service->getBackend()->logs, 'Logs did not start out empty as expected!');
		$this->logger_service->disableLogging(true);
		$this->logger_service->log('This is a log message');
		$this->assertEmpty($this->logger_service->getBackend()->logs, 'Logs did not stay empty after disabling logging!');
		$this->logger_service->disableLogging(false);
		$this->logger_service->log('This is a log message');
		$this->assertNotEmpty($this->logger_service->getBackend()->logs, 'Logs were still empty after enabling logging!');
	}

	public function testSettingInvalidBackend(){		
		try{
			$this->logger_service->setBackend(new \stdClass());
		}catch(Exception $e){

		}
		$this->assertInstanceOf('\Exception', $e, 'Failed to throw an exception when invalid backend was set!');
	}
}
?>