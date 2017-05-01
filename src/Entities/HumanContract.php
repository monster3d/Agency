<?php namespace Monster3D\Agency\Entities;

interface HumanContract
{

    /**
     *
     * Get human name
     *
     * @return string
     */
    public function getName();

    /**
     *
     * Get human age
     *
     * @return int
     *
     */
    public function getAge();

    /**
     *
     * Get human weight
     *
     * @return int
     *
     */
    public function getWeight();

    /**
     *
     * Get human gander
     *
     * @return string
     *
     */
    public function getGander();

    /**
     *
     * Get human skin color
     *
     * @return string
     *
     */
    public function getColor();
}
