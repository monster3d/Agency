<?php namespace Monster3D\Agency;

class Application
{

    /**
     *
     * Force stop application
     *
     */
    public static function stop()
    {
        exit();
    }

    /**
     *
     * Force resp 404 error code
     *
     */
    public static function stop404()
    {
        header('HTTP/1.1 404 Not Found');
        exit();
    }

    /**
     *
     * Force resp 200 success code
     *
     */
    public static function stop200()
    {
        //@todo need implemented
    }

    /**
     *
     * Force resp 201 success was created code
     *
     */
    public static function stop201()
    {
        //@todo need implemented
    }
}
