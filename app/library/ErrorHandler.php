<?php
namespace app\library;

/**
 * Class ErrorHandler
 *
 * @package app\library
 */
class ErrorHandler {

    protected static $errors = array();

    /**
     * Logging errors
     *
     * @param $key
     * @param $error
     */
    public static function logError($key, $error)
    {
        static::$errors[$key] = $error;
    }

    /**
     * Showing errors
     *
     * @param $key
     * @return null
     */
    public static function showError($key)
    {
        return isset(self::$errors[$key]) ? self::$errors[$key] : null;
    }
}