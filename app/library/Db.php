<?php
namespace app\library;

use \PDO;

/**
 * Class Db
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
    public static function getConnection()
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
            Error::logError('db_connection', $e->getMessage());
        }
    }
}