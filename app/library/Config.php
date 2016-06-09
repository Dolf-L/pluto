<?php
namespace app\library;

/**
 * Class Config
 *
 * @package app\library
 */
class Config
{
    protected static $settings = array();

    /**
     * Config constructor.
     *
     * @param $key
     */
    public function __construct($key)
    {
        return isset(self::$settings[$key]) ? self::$settings[$key] : null;
    }

    /**
     * set parameters to config directory
     *
     * @param $key
     * @param $value
     */
    public static function set($key, $value)
    {
        self::$settings[$key] = $value;
    }

    /**
     * get parameters from config directory
     *
     * @param $key
     * @return null
     */
    public static function get($key)
    {
        require_once ROOT . "/app/config/{$key}.php";
        return isset(self::$settings[$key]) ? self::$settings[$key] : null;
    }
}


