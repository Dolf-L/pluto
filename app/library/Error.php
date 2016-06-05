<?php
namespace app\library;



class Error {

    protected static $errors = array();

    public static function logError($key, $error)
    {
        static::$errors[$key] = $error;
    }
    public static function showError()
    {
        return self::$errors;
    }
}