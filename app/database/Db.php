<?php
namespace app\database;

use app\library\ErrorHandler;
use \PDO;
use \PDOException;
use app\library\Config;

/**
 * Class Db
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
    public static function getInstance()
    {
        $params = Config::get('db_params');

        try {
            if (!isset(self::$instance)) {

                $charset = 'utf8';
                $dns = "mysql:host={$params['host']};dbname={$params['dbname']};charset={$charset}";
                $opt = array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                );
                self::$instance = new PDO($dns, $params['user'], $params['password'], $opt);
            }
            return self::$instance;
        } catch (PDOException $e) {
            ErrorHandler::logError('db_connection', $e->getMessage());
        }
    }
}