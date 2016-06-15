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
    /**
     * Connection
     *
     * connection to database
     *
     * @return PDO
     */
    public function getConnection()
    {
        try {
            $params = Config::get('db_params');
            $dns = "mysql:host={$params['host']};dbname={$params['dbname']};charset={$params['charset']}";
            return $db = new PDO($dns, $params['user'], $params['password'], $params['options']);
        } catch (PDOException $e) {
            ErrorHandler::logError('db_connection', $e->getMessage());
        }
    }
}