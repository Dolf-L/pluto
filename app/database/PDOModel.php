<?php
namespace app\database;

use app\library\ErrorHandler;
use PDOException;

/**
 * Base model
 *
 * abstract class, describes major actions which must contain every model
 */
class PDOModel implements IModel
{
    public $db;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = Db::getConnection();
    }

    /**
     * Helper
     *
     * produce SET statement
     *
     * @param $array
     * @return string
     */
    public function pdoSet($array)
    {
        $temp = array();
        foreach (array_keys($array) as $name) {
            $temp[] = "`$name` = ?";
        }
        return implode(', ', $temp);
    }

    /**
     * Show data
     *
     * show all data from database
     *
     * @param $table_name
     * @return array
     */
    public function view($table_name)
    {
        try {
            $sql = "SELECT * FROM $table_name";
            $stmt = $this->db->query($sql);
            $list = $stmt->fetchAll();
            return $list;
        } catch (PDOException $e) {
            ErrorHandler::logError('pdo_error', $e->getMessage());
        }
    }

    /**
     * Search
     *
     * pick one string from database by id
     *
     * @param $table_name
     * @param $id
     * @return array
     */
    public function search($table_name, $id)
    {
        try {
                $sql = "SELECT * FROM $table_name WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $one = $stmt->fetchAll();
                return $one;
        } catch (PDOException $e) {
            ErrorHandler::logError('pdo_error', $e->getMessage());
        }
    }

    /**
     * Add new
     *
     * Add new data to database
     *
     * @param $table_name
     * @param $data
     */
    public function add($table_name, $data)
    {
        try {
            $fields = array_keys($data);
            $values = array_values($data);
            $fields_list = '`' . implode('`, `', $fields) . '`';
            $qm = substr(str_repeat('?,', count($fields)), 0, -1);
            $sql = "INSERT INTO $table_name ($fields_list) VALUES ($qm)";
            $stmt = $this->db->prepare($sql);
            if ($data) {
                $stmt->execute($values);
            }
        } catch (PDOException $e) {
            ErrorHandler::logError('pdo_error', $e->getMessage());
        }
    }

    /**
     * Update data
     *
     * update data in database
     *
     * @param $table_name
     * @param $data
     * @param $id
     */
    public function update($table_name, $data, $id)
    {
        try {
            $query = "UPDATE $table_name SET " . $this->pdoSet($data) . " WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $values = array_values($data);
            $values[] = $id;
            if ($data) {
                $stmt->execute($values);
            }
        } catch (PDOException $e) {
            ErrorHandler::logError('pdo_error', $e->getMessage());
        }
    }

    /**
     * Delete
     *
     * delete data from database by id
     *
     * @param $table_name
     * @param $id
     */
    public function delete($table_name, $id)
    {
        try {
            $sql = "DELETE FROM $table_name WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            ErrorHandler::logError('pdo_error', $e->getMessage());
        }
    }
}