<?php

require_once '../lib/Sixreps/Client.php';

class PhotoTest extends PHPUnit_Framework_TestCase {

	public function setUp() {
		$this->photo = $this->getMockBuilder('Sixreps_Api_Photo')
		                    ->disableOriginalConstructor()
		                    ->getMock();
	}

	public function testGetPhoto() {
		$result = new StdClass;
    	$result->title = 'Mock Photo';
    	$result->owner = new stdClass;
    	$result->owner->name = 'John Doe';

		$this->photo->expects($this->any())
		            ->method('getPhoto')
		            ->with(1)
		            ->will($this->returnValue($result));

		$this->photo->getPhoto(1);
	}

	public function testGetComments() {
		$result = new StdClass;
		$result->data[0] = new stdClass;
		$result->data[0]->body = '';
		$result->data[0]->from = new stdClass;
		$result->data[0]->from->id = 1234;
		$result->data[0]->from->name = 'John Doe';

		$this->photo->expects($this->any())
		            ->method('getComments')
		            ->with(1)
		            ->will($this->returnValue($result));

		$this->photo->getComments(1);
	}

	public function testGetLikes() {
		$result = new StdClass;
		$result->data[0] = new stdClass;
		$result->data[0]->id = 1234;
		$result->data[0]->name = 'John Doe';

		$this->photo->expects($this->any())
		            ->method('getLikes')
		            ->with(1)
		            ->will($this->returnValue($result));

		$this->photo->getLikes(1);
	}

}
