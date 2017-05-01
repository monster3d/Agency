<?php namespace Monster3D\Agency;

class Container
{

    /**
     *
     * Application name
     *
     * @var string
     *
     */
    private $name;

    /**
     *
     * Modules storage
     *
     * @var array
     *
     */
    private $modules;

    /**
     *
     * Container constructor.
     *
     * @param string $name Application name
     *
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     *
     * Add model to container
     *
     * @param string|int $key
     * @param mixed $module
     *
     * @return Container
     *
     */
    public function put($key, &$module)
    {
        $this->modules[$key] = $module;
        return $this;
    }

    /**
     *
     * Get module by key from container
     *
     * @param string|int $key
     *
     * @return mixed|null
     *
     */
    public function &get($key)
    {
        return array_key_exists($key, $this->modules) ? $this->modules[$key] : null;
    }

    /**
     *
     * Get Application name
     *
     * @return string
     *
     */
    public function getName()
    {
        return $this->name;
    }
}
