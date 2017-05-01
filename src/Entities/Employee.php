<?php namespace Monster3D\Agency\Entities;

class Employee extends Human implements HumanContract, EmployeeContract
{

    /**
     *
     * Employee base description
     *
     * @var string
     *
     */
    protected $description;

    /**
     *
     * Rate per hour
     *
     * @var
     *
     */
    protected $rate;

    /**
     *
     * Employee constructor.
     *
     * @param string $name
     * @param int $age
     * @param int $weight
     * @param string $gander
     * @param string $color
     * @param string $description
     * @param int $rate
     *
     */
    public function __construct($name, $age, $weight, $gander, $color, $description, $rate)
    {
        $this->description = $description;
        $this->rate        = (int) $rate;
        parent::__construct($name, $age, $weight, $gander, $color);
    }

    /**
     *
     * Get human name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * Get human age
     *
     * @return int
     *
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     *
     * Get human weight
     *
     * @return int
     *
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     *
     * Get human gander
     *
     * @return string
     *
     */
    public function getGander()
    {
        return $this->gander;
    }

    /**
     *
     * Get human skin color
     *
     * @return string
     *
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     *
     * Get information about the slave
     *
     * @return string
     *
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     *
     * Get working rate per hour
     *
     * @return int
     *
     */
    public function getRate()
    {
        return $this->rate;
    }
}

