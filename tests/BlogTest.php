<?php

require_once '../lib/Sixreps/Client.php';

class BlogTest extends PHPUnit_Framework_TestCase {

	public function setUp() {
		$this->blog = $this->getMockBuilder('Sixreps_Api_Blog')
		                   ->disableOriginalConstructor()
		                   ->getMock();
	}

	public function testGetBlog() {
		$result = new StdClass;
    	$result->title = 'Mock Blog';
    	$result->owner = new stdClass;
    	$result->owner->name = 'John Doe';

		$this->blog->expects($this->any())
		           ->method('getBlog')
		           ->with(1)
		           ->will($this->returnValue($result));

		$this->assertEquals($result, $this->blog->getBlog(1));
	}

	public function testGetComments() {
		$result = new StdClass;
		$result->data[0] = new stdClass;
		$result->data[0]->body = '';
		$result->data[0]->from = new stdClass;
		$result->data[0]->from->id = 1234;
		$result->data[0]->from->name = 'John Doe';

		$this->blog->expects($this->any())
		           ->method('getComments')
		           ->with(1)
		           ->will($this->returnValue($result));

		$this->assertEquals($result, $this->blog->getComments(1));
	}

	public function testGetLikes() {
		$result = new StdClass;
		$result->data[0] = new stdClass;
		$result->data[0]->id = 1234;
		$result->data[0]->name = 'John Doe';

		$this->blog->expects($this->any())
		           ->method('getLikes')
		           ->with(1)
		           ->will($this->returnValue($result));

		$this->assertEquals($result, $this->blog->getLikes(1));
	}

}
