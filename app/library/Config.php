<?php
namespace app\library;

require_once ROOT . "/app/config/db_params.php";
require_once ROOT . "/app/config/routes.php";


class Config
{
    protected static $settings = array();

    public static function get($key)
    {
        return isset(self::$settings[$key]) ? self::$settings[$key] : null;
    }
    public static function set($key, $value)
    {
        self::$settings[$key] = $value;
    }
}


