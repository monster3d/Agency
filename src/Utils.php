<?php namespace Monster3D\Agency;

class Utils
{

    /**
     *
     * Set type from scheme
     *
     * @param array $data
     * @param array $scheme
     *
     */
    public static function setType(array &$data, array $scheme)
    {
        foreach ($data as $key => $_) {
            setType($data[$key], $scheme[$key]);
        }
    }
}
