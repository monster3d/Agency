<?php namespace Monster3D\Agency\Providers;

use Monster3D\Agency\Container;
use Monster3D\Agency\Exceptions\EmployeeException;
use Monster3D\Agency\Exceptions\ValidationException;
use Monster3D\Agency\Status;

class Employee
{
    /**
     *
     * Stack for employee
     *
     * @var array
     *
     */
    private $employees;

    /**
     *
     * Container
     *
     * @var Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->employees = [];
    }

    /**
     *
     * Create new employee
     *
     * @param string $status
     * @param array $settings
     *
     * @throws EmployeeException Error on stage create employee
     * @throws ValidationException Error validation data
     *
     * @return Employee;
     *
     * @example $settings['name' => 'Jho', 'age' => 40, 'weight' => 75, 'gander' => 'male', 'color' => 'black',
     *      'description' => 'From nevada', 'rate' => 10, 'cost' => 500];
     *
     */
    public function create($status, array $settings)
    {

        $validator = $this->container->get('validator');
        $validator->validation_rules(
            [
                'name'        => 'required|alpha_numeric|max_len,100|min_len,3',
                'age'         => 'required|integer',
                'weight'      => 'required|integer',
                'gander'      => 'required|contains,male,female',
                'color'       => 'required|alpha_numeric',
                'description' => 'max_len,500',
                'rate'        => 'integer',
                'cost'        => 'integer'
            ]
        );

        if ($validator->run($settings) === false) {
            throw new ValidationException($validator->get_readable_errors(true));
        }

        $class = sprintf("\\Monster3D\\Agency\\Entities\\%s", $status);
        if (!class_exists($class)) {
            throw new EmployeeException(sprintf("Not found unit by name %s", $status));
        }

        $employee = new $class($settings['name'], $settings['age'], $settings['weight'], $settings['gander'],
            $settings['color'], $settings['description'], $settings['rate'], $settings['cost']);
        array_unshift($this->employees, $employee);
        return $employee;
    }

    /**
     *
     * Check status
     *
     * @param array $employee
     *
     * @return array
     *
     */
    public function status($employee)
    {
        $result = ['status' => 'free'];
        if ($employee) {
            $result['status'] = 'busy';
            $result = array_merge($result, $employee);
        }
        return $result;
    }

    /**
     *
     * Get info employee by id
     *
     * @param array $employee
     *
     * @return array
     *
     */
    public function info($employee)
    {
        $category = [];
        foreach ($employee as $data) {
            $category[] = [
                'id'    => $data['id'],
                'title' => $data['cat_title']
            ];
        }
        $result = array_pop($employee);
        unset($result['id'], $result['cat_title']);
        $result = array_merge($result, ['categories' => $category]);
        return $result;
    }

    public function rent(array $data, $storage)
    {
        $validator = $this->container->get('validator');
        /**
         *
         * @todo Need create customer validation rule on regexp for datetime validation
         *
         */
        $validator->validation_rules(
            [
                'employee_id' => 'required|integer',
                'from'        => 'required',
                'to'          => 'required',
                'action_id'   => 'required'
            ]
        );

        if ($validator->run($data) === false) {
            throw new ValidationException($validator->get_readable_errors(true));
        }

        $status = $storage->status($data['employee_id']);

        if ($status !== false) {
            throw new EmployeeException(sprintf("Employee ID: %s now busy, check API method -status- for more information"));
        }

        $employee = array_pop($storage->info($data['employee_id']));
        $employee['id'] = $data['employee_id'];
        $employee = $this->create(Status::SLAVE, $employee);

        $calculate    = new Calculation($employee);
        $dateTimeFrom = \DateTime::createFromFormat('Y-m-d H:i:s', $data['from']);
        $dateTimeTo   = \DateTime::createFromFormat('Y-m-d H:i:s', $data['to']);

        $totalCost = $calculate->calculate($dateTimeFrom, $dateTimeTo);
        return $totalCost;
    }
}
