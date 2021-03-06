<?php

namespace app\library;

use \ReflectionClass;

class DI
{
    private static $map;

    /**
     * Create instances of classes
     *
     * @param $className
     * @param null $arguments
     * @return object
     */
    public static function getInstanceOf($className, $arguments = null) {

        require_once ROOT . '/app/config/mapping.php';

        if(!class_exists($className)) {
            ErrorHandler::logError('di_error', "DI: missing class '" . $className . "'.");
        }

        $reflection = new ReflectionClass($className);

        if($arguments === null || count($arguments) == 0) {
            $obj = new $className;
        } else {
            if(!is_array($arguments)) {
                $arguments = array($arguments);
            }
            $obj = $reflection->newInstanceArgs($arguments);
        }

        if($doc = $reflection->getDocComment()) {
            $lines = explode("\n", $doc);
            foreach($lines as $line) {
                if(count($parts = explode("@Inject", $line)) > 1) {
                    $parts = explode(" ", $parts[1]);
                    if(count($parts) > 1) {
                        $key = $parts[1];
                        $key = str_replace("\r", "", $key);
                        if(isset(self::$map->$key)) {
                            switch(self::$map->$key->type) {
                                case "class":
                                    $obj->$key = self::getInstanceOf(self::$map->$key->value, self::$map->$key->arguments);
                                    break;
                                case "classSingleton":
                                    if(self::$map->$key->instance === null) {
                                        $obj->$key = self::$map->$key->instance = self::getInstanceOf(self::$map->$key->value, self::$map->$key->arguments);
                                    } else {
                                        $obj->$key = self::$map->$key->instance;
                                    }
                                    break;
                            }
                        }
                    }
                }
            }
        }

        return $obj;

    }

    /**
     * Mapping classes
     *
     * @param $key
     * @param $value
     * @param null $arguments
     */
    public static function mapClass($key, $value, $arguments = null) {
        self::addToMap($key, (object) array(
            "value" => $value,
            "type" => "class",
            "arguments" => $arguments
        ));
    }

    /**
     * Mapping singleton classes
     *
     * @param $key
     * @param $value
     * @param null $arguments
     */
    public static function mapClassAsSingleton($key, $value, $arguments = null) {
        self::addToMap($key, (object) array(
            "value" => $value,
            "type" => "classSingleton",
            "instance" => null,
            "arguments" => $arguments
        ));
    }

    /**
     * Arrange keys and values
     *
     * @param $key
     * @param $obj
     */
    private static function addToMap($key, $obj) {
        if(self::$map === null) {
            self::$map = (object) array();
        }
        self::$map->$key = $obj;
    }

}