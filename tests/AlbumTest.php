<?php

require_once '../lib/Sixreps/Client.php';

class AlbumTest extends PHPUnit_Framework_TestCase {

	public function setUp() {
		$this->album = $this->getMockBuilder('Sixreps_Api_Album')
		                    ->disableOriginalConstructor()
		                    ->getMock();
	}

	public function testGetAlbum() {
		$result = new StdClass;
    	$result->title = 'Mock Album';
    	$result->owner = new stdClass;
    	$result->owner->name = 'John Doe';

		$this->album->expects($this->any())
		            ->method('getAlbum')
		            ->with(1)
		            ->will($this->returnValue($result));

		$this->assertEquals($result, $this->album->getAlbum(1));
	}

	public function testGetComments() {
		$result = new StdClass;
		$result->data[0] = new stdClass;
		$result->data[0]->body = '';
		$result->data[0]->from = new stdClass;
		$result->data[0]->from->id = 1234;
		$result->data[0]->from->name = 'John Doe';

		$this->album->expects($this->any())
		            ->method('getComments')
		            ->with(1)
		            ->will($this->returnValue($result));

		$this->assertEquals($result, $this->album->getComments(1));
	}

	public function testGetLikes() {
		$result = new StdClass;
		$result->data[0] = new stdClass;
		$result->data[0]->id = 1234;
		$result->data[0]->name = 'John Doe';

		$this->album->expects($this->any())
		            ->method('getLikes')
		            ->with(1)
		            ->will($this->returnValue($result));

		$this->assertEquals($result, $this->album->getLikes(1));
	}

}
