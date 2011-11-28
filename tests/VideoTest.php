<?php

require_once '../lib/Sixreps/Client.php';

class VideoTest extends PHPUnit_Framework_TestCase {

	public function setUp() {
		$this->video = $this->getMockBuilder('Sixreps_Api_Video')
		                    ->disableOriginalConstructor()
		                    ->getMock();
	}

	public function testGetVideo() {
		$result = new StdClass;
    	$result->title = 'Mock Video';
    	$result->owner = new stdClass;
    	$result->owner->name = 'John Doe';

		$this->video->expects($this->any())
		            ->method('getVideo')
		            ->with(1)
		            ->will($this->returnValue($result));

		$this->video->getVideo(1);
	}

	public function testGetComments() {
		$result = new StdClass;
		$result->data[0] = new stdClass;
		$result->data[0]->body = '';
		$result->data[0]->from = new stdClass;
		$result->data[0]->from->id = 1234;
		$result->data[0]->from->name = 'John Doe';

		$this->video->expects($this->any())
		            ->method('getComments')
		            ->with(1)
		            ->will($this->returnValue($result));

		$this->video->getComments(1);
	}

	public function testGetLikes() {
		$result = new StdClass;
		$result->data[0] = new stdClass;
		$result->data[0]->id = 1234;
		$result->data[0]->name = 'John Doe';

		$this->video->expects($this->any())
		            ->method('getLikes')
		            ->with(1)
		            ->will($this->returnValue($result));

		$this->video->getLikes(1);
	}

}