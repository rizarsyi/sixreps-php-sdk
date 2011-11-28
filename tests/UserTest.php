<?php

require_once '../lib/Sixreps/Client.php';

class UserTest extends PHPUnit_Framework_TestCase {

	public function setUp() {
		$this->user = $this->getMockBuilder('Sixreps_Api_User')
		                   ->disableOriginalConstructor()
		                   ->getMock();
	}

	public function testGetUser() {
		$result = new StdClass;
    	$result->username = 'johndoe';

		$this->user->expects($this->any())
		           ->method('getUser')
		           ->with(1)
		           ->will($this->returnValue($result));

		$this->user->getUser(1);
	}

}
