<?php namespace Monster3D\Agency\Entities;

interface EmployeeContract
{

    /**
     *
     * Get information about the slave
     *
     * @return string
     *
     */
    public function getDescription();

    /**
     *
     * Get working rate per hour
     *
     * @return int
     *
     */
    public function getRate();
}
