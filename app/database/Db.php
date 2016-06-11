<?php
namespace app\database;

use app\library\ErrorHandler;
use \PDO;
use \PDOException;
use app\library\Config;

/**
 * Class Db
 *
 * work with database
 */

class Db
{
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    /**
     * Connection
     *
     * connection to database
     *
     * @return PDO
     */
    public static function getConnection()
    {
        try {
            if (!isset(self::$instance)) {
                $params = Config::get('db_params');
                $dns = "mysql:host={$params['host']};dbname={$params['dbname']};charset={$params['charset']}";
                self::$instance = new PDO($dns, $params['user'], $params['password'], $params['options']);
            }
            return self::$instance;
        } catch (PDOException $e) {
            ErrorHandler::logError('db_connection', $e->getMessage());
        }
    }
}