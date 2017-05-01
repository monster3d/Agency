<?php namespace Monster3D\Agency\Providers;

use Monster3D\Agency\Entities\EmployeeContract;
use \DateTime;

class Calculation
{

    /**
     *
     * Count hours in work day
     *
     * @var int
     *
     */
    private $workingDay;

    /**
     *
     * Employee
     *
     * @var EmployeeContract
     *
     */
    private $employee;

    /**
     *
     * Calculate construct
     *
     * @param EmployeeContract $employee
     * @param int $workingDay
     *
     */
    public function __construct(EmployeeContract $employee, $workingDay = 16)
    {
        $this->workingDay = $workingDay;
        $this->employee   = $employee;
    }

    /**
     *
     * Calculate between datetime
     *
     * @param DateTime $from
     * @param DateTime $to
     *
     * @return int
     *
     */
    public function calculate(DateTime $from, DateTime $to)
    {
        $employeeRate = $this->employee->getRate();
        $dataDiff     = $from->diff($to);
        $hours        = $dataDiff->h;
        $days         = $dataDiff->days;

        if ($days > 0) {
            $totalCost = ($this->workingDay * $employeeRate) * $days;
        } else {
            $totalCost = $employeeRate * $hours;
        }

        return $totalCost;
    }

    /**
     *
     * Set customer workday for employee
     *
     * @param $workingDay
     *
     * @return self
     *
     */
    public function setWorkingDay($workingDay)
    {
        $this->workingDay = (int) $workingDay;
        return $this;
    }

    /**
     *
     * Exchange
     *
     * @param int $gold
     *
     * @return int
     *
     */
    public function exchange($gold)
    {
        //@todo implement method from exchange coin
    }
}
