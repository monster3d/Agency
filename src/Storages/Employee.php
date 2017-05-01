<?php namespace Monster3D\Agency\Storages;

use Monster3D\Agency\Container;
use Monster3D\Agency\Entities\SlaveContract;

/**
 *
 *
 * Class Employee
 * @package Monster3D\Agency\Storages
 *
 * @todo Хорошо бы сделать чтоб Storage оперировал только объектами
 *
 */

class Employee {

    /**
     *
     * Container
     *
     * @var Container
     *
     */
    private $container;

    /**
     *
     * Table name
     *
     * @var string
     *
     */
    private $table;

    /**
     *
     * Employee constructor.
     *
     * @param Container $container
     *
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     *
     * Save object salve to database
     *
     * @param SlaveContract $slave
     *
     */
    public function save(SlaveContract $slave)
    {
        $db = $this->container->get('db');
        $db->insert('employees', $slave->toArray());
    }

    /**
     *
     * Get employee list
     *
     * @param $limit
     * @param int $offset
     *
     */
    public function get($limit, $offset = 0)
    {
        $db  = $this->container->get('db');
        $sql = sprintf("SELECT `id`, `name`, `age`, `weight`, `gander`, `color`, `description`, `rate`, `cost`
                        FROM `employees` LIMIT %d, %d", $offset, $limit);

        $stmt   = $db->query($sql);
        $result = $stmt->fetchAll();
        return $result;
    }

    /**
     *
     * Check employee current status
     *
     * @param $id
     * @return array|boolean
     *
     */
    public function status($id)
    {
        $db = $this->container->get('db');

        $sql = "SELECT `em`.`id` AS `employee_id`, `ems`.`start` AS `start_work`, `ems`.`finish` AS `finish_work`, `ai`.`title` AS `he_doing` 
                FROM `employees` AS `em` 
                RIGHT JOIN `employee_status` AS `ems` ON `em`.`id` = `ems`.`employee_id`
                LEFT JOIN `activity_items` AS `ai` ON `ai`.`id` = `ems`.`of_activity_id` 
                WHERE `em`.`id` = :id";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    /**
     *
     * Get info by id
     *
     * @param int $id
     * @return array
     *
     */
    public function info($id)
    {
        $db = $this->container->get('db');

        /**
         *
         * @todo this sql need to divide into part
         *
         */
        $sql = "SELECT `cat`.`id` AS `id`, `em`.`name` AS `name`, `em`.`age` AS `age`, `em`.`weight` AS `weight`, `em`.`gander` AS `gander`, `em`.`color` AS `color`, 
                  `em`.`description` AS `description`, `em`.`rate` AS `rate`, `em`.`cost` AS `cost`, `cat`.`title` AS `cat_title` FROM `employees` AS `em` 
                RIGHT JOIN `employee_category` AS `emc` ON `em`.`id` = `emc`.`employee_id`
                LEFT JOIN `categories` AS `cat` ON `emc`.`category_id` = `cat`.`id` WHERE `em`.`id` = :id";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    /**
     *
     * Hire an employee
     *
     * @param int $clientId
     * @param int $employeeId
     * @param string $fromDateTime
     * @param string $toDateTime
     * @param int $actionId
     *
     */
    public function hire($clientId, $employeeId, $fromDateTime, $toDateTime, $actionId)
    {
        $db = $this->container->get('db');

        $data = [
            'client_id'      => $clientId,
            'of_activity_id' => $actionId,
            'start'          => $fromDateTime,
            'finish'         => $toDateTime,
            'employee_id'    => $employeeId
        ];
        $db->insert('employee_status', $data);
    }
}
