<?php namespace Monster3D\Agency\Entities;

interface SlaveContract extends EmployeeContract, HumanContract
{

    /**
     *
     * Get full cost slave
     *
     * @return int
     *
     */
    public function getCost();
}
