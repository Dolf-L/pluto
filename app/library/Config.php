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


    public function __construct($key)
    {
        return isset(self::$settings[$key]) ? self::$settings[$key] : null;
    }

    public static function get($key)
    {
        require_once ROOT . "/app/config/{$key}.php";
        return isset(self::$settings[$key]) ? self::$settings[$key] : null;
    }

    public static function set($key, $value)
    {
        self::$settings[$key] = $value;
    }
}


