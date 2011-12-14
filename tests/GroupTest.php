<?php

require_once '../lib/Sixreps/Client.php';

class GroupTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->group = $this->getMockBuilder('Sixreps_Api_Group')
                            ->disableOriginalConstructor()
                            ->getMock();
    }

    public function testGetGroup() {
        $result = new StdClass;
        $result->title = 'Mock Group';

        $this->group->expects($this->any())
                    ->method('getGroup')
                    ->with(1)
                    ->will($this->returnValue($result));

        $this->assertEquals($result, $this->group->getGroup(1));
    }

}
