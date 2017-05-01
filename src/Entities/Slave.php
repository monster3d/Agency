<?php namespace Monster3D\Agency\Entities;

final class Slave extends Employee implements SlaveContract, ArrayContract
{

    /**
     *
     * Cost for buy Slave
     *
     * @var int
     *
     */
    private $cost;

    /**
     *
     * @see Human, Employee
     *
     * Slave constructor.
     *
     * @param string $name
     * @param int $age
     * @param int $weight
     * @param string $gander
     * @param string $color
     * @param string $description
     * @param int $rate
     * @param int $cost
     *
     */
    public function __construct($name, $age, $weight, $gander, $color, $description, $rate, $cost)
    {
        $this->cost = (int) $cost;
        parent::__construct($name, $age, $weight, $gander, $color, $description, $rate);
    }

    /**
     *
     * Get full cost employee
     *
     * @return int
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     *
     * To Array
     *
     * @return array
     *
     */
    public function toArray()
    {
        $array = [
            'name'        => $this->name,
            'age'         => $this->age,
            'weight'      => $this->weight,
            'gander'      => $this->gander,
            'color'       => $this->color,
            'description' => $this->description,
            'rate'        => $this->rate,
            'cost'        => $this->cost
        ];
        return $array;
    }
}
