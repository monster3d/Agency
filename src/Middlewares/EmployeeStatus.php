<?php namespace Monster3D\Agency\Middleware;

use Monster3D\Agency\Container;

class EmployeeStatus implements MiddlewareContract
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     *
     * Clear employee status after end work time
     *
     */
    public function execute()
    {
        $db = $this->contanier->get('db');

        $sql    = "SELECT `employee_id` AS `id` FROM `employee_status` WHERE `finish` < NOW()";
        $stmt   = $db->query($sql);
        $result = $stmt->fetchAll();

        if (!$result) {
            return;
        }

        foreach ($result as $busyEmployee) {
            $db->delete('employee_status', ['employee_id' => $busyEmployee['id']]);
        }
    }
}
