<?php

use PHPUnit\Framework\TestCase;

class BaseEmployeeTest extends TestCase
{
    public $employee;

    public function setUp()
    {
        $this->employee = new  \Monster3D\Agency\Entities\Employee('Test Name', 25, 60, 'male', 'black', 'Test Desc', 20);
    }

    public function tearDown()
    {
        $this->employee = null;
    }

    public function testCanCreateBaseEmployeeObject()
    {
        self::assertInstanceOf(Monster3D\Agency\Entities\Employee::class, $this->employee);
    }

    public function testCanGetNameEmployee()
    {
        $name = $this->employee->getName();
        $this->assertInternalType('string', $name);
        $this->assertEquals('Test Name', $name);
    }

    public function testCanGetAgeEmployee()
    {
        $age = $this->employee->getAge();
        $this->assertInternalType('integer', $age);
        $this->assertEquals(25, $age);
    }

    public function testCanGetWeightEmployee()
    {
        $weight = $this->employee->getWeight();
        $this->assertInternalType('integer', $weight);
        $this->assertEquals(60, $weight);
    }

    public function testCanGetGanderEmployee()
    {
        $gander = $this->employee->getGander();
        $this->assertInternalType('string', $gander);
        $this->assertEquals('male', $gander);
    }

    public function testCanGetColorSkinEmployee()
    {
        $color = $this->employee->getColor();
        $this->assertInternalType('string', $color);
        $this->assertEquals('black', $color);
    }

    public function testCanGetDescriptionOfEmployee()
    {
        $description = $this->employee->getDescription();
        $this->assertInternalType('string', $description);
        $this->assertEquals('Test Desc', $description);
    }

    public function testCanGetRatePerHourWorkTimeEmployee()
    {
        $rate = $this->employee->getRate();
        $this->assertInternalType('integer', $rate);
        $this->assertEquals(20, $rate);
    }
}
