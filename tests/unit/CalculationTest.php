<?php

use PHPUnit\Framework\TestCase;

class CalculationTest extends TestCase
{
    public $calculate;

    public function setUp()
    {
        $employee = $this->getMockBuilder(Monster3D\Agency\Entities\Employee::class)
                         ->setMethods(['getRate'])
                         ->disableOriginalConstructor()
                         ->getMock();

        $employee->expects($this->any())
                 ->method('getRate')
                 ->will($this->returnValue(5));

        $this->calculate = new Monster3D\Agency\Providers\Calculation($employee);
    }

    public function tearDown()
    {
        $this->calculate = null;
    }

    public function testCanCreateBaseCalculationObject()
    {
        $this->assertInstanceOf(Monster3D\Agency\Providers\Calculation::class, $this->calculate);
    }

    public function testCanCalculationRantSumPerHour()
    {
        $this->calculate->setWorkingDay(16);
        $from = DateTime::createFromFormat("Y-m-d H:i:s", "2017-04-29 16:29:20");
        $to   = DateTime::createFromFormat("Y-m-d H:i:s", "2017-04-29 18:29:20");
        $result = $this->calculate->calculate($from, $to);

        /*
         * a rate per hour
         * b work hour
         * 10 = a * b
         */
        $this->assertEquals(10, $result, $result);
    }

    public function testCanCalculationRentSumPerDay()
    {
        $this->calculate->setWorkingDay(16);
        $from = DateTime::createFromFormat("Y-m-d H:i:s", "2017-04-25 16:29:20");
        $to   = DateTime::createFromFormat("Y-m-d H:i:s", "2017-04-29 18:29:20");
        $result = $this->calculate->calculate($from, $to);

        /*
         * a = rate per hour
         * b = work day in hour
         * c = rent day
         * 320 = (a * b) * c
         */
        $this->assertEquals(320, $result, $result);
    }
}
