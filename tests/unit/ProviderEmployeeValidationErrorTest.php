<?php
use PHPUnit\Framework\TestCase;

class ProviderEmployeeValidationErrorTest extends TestCase
{
    public $provider;

    public function setUp()
    {
        $validator = $this->getMockBuilder(GUMP::class)
                  ->setMethods(['validation_rules', 'run', 'get_readable_errors'])
                  ->disableOriginalConstructor()
                  ->getMock();

        $validator->expects($this->any())
                  ->method('validation_rules')
                  ->with($this->isType('array'));

        $validator->expects($this->any())
                  ->method('run')
                  ->with($this->isType('array'))
                  ->will($this->returnValue(false));

        $container = $this->getMockBuilder(Monster3D\Agency\Container::class)
                  ->setMethods(['get'])
                  ->disableOriginalConstructor()
                  ->getMock();

        $container->expects($this->any())
                  ->method('get')
                  ->with($this->isType('string'))
                  ->will($this->returnValue($validator));

        $this->provider = new Monster3D\Agency\Providers\Employee($container);
    }

    public function tearDown()
    {
        $this->provider = null;
    }

    public function testCanBaseCreateEmployeeProvider()
    {
        self::assertInstanceOf(Monster3D\Agency\Providers\Employee::class, $this->provider);
    }

    /**
     *
     * @expectedException Monster3D\Agency\Exceptions\ValidationException;
     *
     */
    public function testCanCreateWithValidationError()
    {
        $data = [
            'name'        => 'TestName',
            'age'         => 40,
            'weight'      => 90,
            'gander'      => 'male',
            'color'       => 'black',
            'description' => 'TestDesc',
            'rate'        => 10,
            'cost'        => 900
        ];
        $this->provider->create('Slave', $data);
    }
}