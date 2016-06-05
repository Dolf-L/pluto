<?php
namespace app\library;

use \PDO;
use app\library\Error;

/**
 * Class Db
 * work with database
 */

class Db
{
    /**
     * Connection
     *
     * @return PDO
     *
     * connection database
     */
    public function getConnection()
    {
        $params = Config::get('db_params');

        try {
            $charset = 'utf8';
            $dns = "mysql:host={$params['host']};dbname={$params['dbname']};charset={$charset}";
            $opt = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );
            $db = new PDO($dns, $params['user'], $params['password'], $opt);
            return $db;
        } catch (PDOException $e) {
            new Error($e->getMessage());
        }
    }
}