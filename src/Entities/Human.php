<?php namespace Monster3D\Agency\Entities;


class Human
{

    /**
     *
     * Human name
     *
     * @var string
     *
     */
    protected $name;

    /**
     *
     * Human age
     *
     * @var int
     *
     */
    protected $age;

    /**
     *
     * Human weight
     *
     * @var int
     *
     */
    protected $weight;

    /**
     *
     * Human gender
     *
     * @var string
     *
     */
    protected $gander;

    /**
     *
     * Human skin color
     *
     * @var string
     *
     */
    protected $color;

    /**
     *
     *
     * Human constructor.
     *
     * @param string $name
     * @param int $age
     * @param int $weight
     * @param string $gander
     * @param string $color
     *
     */
    public function __construct($name, $age, $weight, $gander, $color)
    {
        $this->name   = $name;
        $this->age    = (int) $age;
        $this->weight = (int) $weight;
        $this->gander = $gander;
        $this->color  = $color;
    }
}
