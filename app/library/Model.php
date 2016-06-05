<?php
namespace app\library;

use app\library\Error;
use app\validation\Filtration;
use PDOException;

/**
 * Base model
 *
 * abstract class, describes major actions which must contain every model
 */
abstract Class Model
{
    public $db;
    public $table_name;

    public function __construct(Db $db, $table_name)
    {
        $this->db = $db->getConnection();
        $this->table_name = $table_name;
    }

    /**
     * update helper
     *
     * @param $array
     * @return string
     *
     * produce SET statement
     */
    function pdoSet($array)
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
     * @param $table_name
     * @return array
     *
     * show all data from database
     */
    public function view($table_name)
    {
        try {
            $sql = "SELECT * FROM $table_name";
            $stmt = $this->db->query($sql);
            $list = $stmt->fetchAll();
            return $list;
        } catch (PDOException $e) {
            Error::logError('pdo_error', $e->getMessage());
        }
    }

    /**
     * Search
     *
     * @param $table_name
     * @param $id
     * @return array
     *
     * pick one string from database by id
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
            Error::logError('pdo_error', $e->getMessage());
        }
    }

    /**
     * Add new
     *
     * @param $table_name
     * @param $data
     *
     * Add new data to database
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
            Error::logError('pdo_error', $e->getMessage());
        }
    }

    /**
     * Update data
     *
     * @param $table_name
     * @param $data
     * @param $id
     *
     * update data in database
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
            Error::logError('pdo_error', $e->getMessage());
        }
    }

    /**
     * Delete
     *
     * @param $table_name
     * @param $id
     *
     * delete data from database
     */
    public function delete($table_name, $id)
    {
        try {
            $sql = "DELETE FROM $table_name WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            Error::logError('pdo_error', $e->getMessage());
        }
    }
}