<?php

require_once '../lib/Sixreps/Client.php';

class EventTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->event = $this->getMockBuilder('Sixreps_Api_Event')
                            ->disableOriginalConstructor()
                            ->getMock();
    }

    public function testGetEvent() {
        $result = new StdClass;
        $result->title = 'Mock Event';

        $this->event->expects($this->any())
                    ->method('getEvent')
                    ->with(1)
                    ->will($this->returnValue($result));

        $this->assertEquals($result, $this->event->getEvent(1));
    }

}
