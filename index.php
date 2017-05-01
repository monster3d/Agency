<?php
require __DIR__ . '/vendor/autoload.php';

use Bramus\Router\Router;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Configuration;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;
use Monster3D\Agency\Container;
use JSend\JSendResponse;
use Monster3D\Agency\Exceptions\ValidationException;
use Monster3D\Agency\Status;
use Monster3D\Agency\Application;

try {
    $config = Yaml::parse(file_get_contents("config.yml"));
} catch (ParseException $e) {
    //@todo logger
}

$db = DriverManager::getConnection($config['database'], new Configuration());

$container = new Container('Agency');
$container->put('db', $db)->put('config', $config)->put('validator', new GUMP());

$router = new Router();

$router->mount('/api', function() use($router, $container) {
    /**
     *
     * Router for employee
     *
     */
    $router->mount('/employee', function() use($router, $container) {

        /**
         *
         * Add new employee
         *
         */
        $router->post('/add', function () use($container) {
            $result           = null;
            $employee         = null;
            $validator        = $container->get('validator');
            $post             = $validator->sanitize($_POST);
            $employeeProvider = new \Monster3D\Agency\Providers\Employee($container);

            try {
                $employee = $employeeProvider->create(Status::SLAVE, $post);
            } catch (ValidationException $e) {
                //@todo logger
                $response = new JSendResponse('fail', ['message' => $e->getMessage()]);
                $response->respond();
                Application::stop();
            }

            $response  = new JSendResponse('success', $employee->toArray());
            $storage   = new Monster3D\Agency\Storages\Employee($container);
            $storage->save($employee);
            $response->respond();
            Application::stop();
        });

        /**
         *
         * Get all employee
         *
         */
        $router->get('/', function() use($container) {
            $limit  = 10;
            $offset = 0;
            if (array_key_exists('limit', $_GET)) {
                $limit = (int) $_GET['limit'];
            }

            if (array_key_exists('offset', $_GET)) {
                $offset = (int) $_GET['limit'];
            }

            $storage  = new \Monster3D\Agency\Storages\Employee($container);
            $result   = $storage->get($limit, $offset);
            $response = new JSendResponse('success', $result);
            $response->respond();
            Application::stop();
        });

        /**
         *
         * Get current status target employee
         *
         */
        $router->get('/status/id/(\d+)', function($id) use($container) {
            $storage  = new \Monster3D\Agency\Storages\Employee($container);
            $provider = new \Monster3D\Agency\Providers\Employee($container);
            $result   = $storage->status((int) $id);
            $result   = $provider->status($result);
            $response = new JSendResponse('success', $result);
            $response->respond();
            Application::stop();
        });

        /**
         *
         * Get info target employee by id
         *
         */
        $router->get('/info/id/(\d+)', function($id) use($container) {
            $storage  = new \Monster3D\Agency\Storages\Employee($container);
            $provider = new \Monster3D\Agency\Providers\Employee($container);
            $result   = $storage->info((int) $id);

            if (!$result) {
                Application::stop404();
            }

            $result = $provider->info($result);
            $response = new JSendResponse('success', $result);
            $response->respond();
            Application::stop();
        });

        /**
         *
         * Try rent of employee
         *
         */
        $router->post('/rent', function() use($container) {
            $validator = $container->get('validator');
            $post      = $validator->sanitize($_POST);
            $provider  = new \Monster3D\Agency\Providers\Employee($container);
            $storage   = new \Monster3D\Agency\Storages\Employee($container);
            $result    = $provider->rent($post, $storage);
            $response  = new JSendResponse('success', ['total_cost' => $result]);
            $storage->hire($post['client_id'], $post['employee_id'], $post['from'], $post['to'], $post['action_id']);
            $response->respond();
            Application::stop();
        });
    });

    /**
     *
     * Exchange
     *
     */
    $router->mount('/exchange', function() use($router, $container) {

        /**
         *
         * Add new exchange rate
         *
         */
        $router->post('/add', function() use ($container) {
            $response = new JSendResponse('success', ['message' => 'Not implemented']);
            $response->respond();
            Application::stop();
        });
    });
});

$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
});

$router->before('GET|POST|PUT', '/api/employee/', function() use($container) {
    $middleware = new \Monster3D\Agency\Middleware\EmployeeStatus($container);
    $middleware->execute();
});

$router->run();
