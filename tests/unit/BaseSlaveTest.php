<?php

use PHPUnit\Framework\TestCase;

class BaseSlaveTest extends TestCase
{
    public $slave;

    public function setUp()
    {
        $this->slave = new Monster3D\Agency\Entities\Slave('Name', 25, 70, 'male', 'black', 'Desc', 10, 600);

    }

    public function tearDown()
    {
        $this->slave = null;
    }

    public function testCanBaseCreateSlaveObject()
    {
        $this->assertInstanceOf(Monster3D\Agency\Entities\Slave::class, $this->slave);
    }

    public function testCanGetFullTotalCostSlave()
    {
        $cost = $this->slave->getCost();
        $this->assertInternalType('integer', $cost);
        $this->assertEquals(600, $cost);
    }
}
