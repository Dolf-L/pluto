<?php
namespace app\library;


/**
 * Base model
 *
 * abstract class, describes major actions which must contain every model
 */
abstract Class Model
{
    public $db;

    /**
     * update helper
     *
     * @param $array
     * @return string
     *
     * produce SET statement
     */
    function pdoSet($array) {
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

            $sql = "SELECT * FROM $table_name";
            $stmt = $this->db->query($sql);
            $list = $stmt->fetchAll();
            return $list;

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

            $sql = "SELECT * FROM $table_name WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $one = $stmt->fetchAll();
            return $one;

    }

    /**
     * Add new
     *
     * @param $table_name
     * @param $data
     *
     * Add new data to database
     */
    public function add($table_name, $data) {
            $fields = array_keys($data);
            $values = array_values($data);
            $fields_list = '`' . implode('`, `', $fields) . '`';
            $qm = substr(str_repeat('?,', count($fields)), 0, -1);
            $sql = "INSERT INTO $table_name ($fields_list) VALUES ($qm)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($values);
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
    public function update($table_name, $data, $id) {

            $query = "UPDATE $table_name SET " . $this->pdoSet($data) . " WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $values = array_values($data);
            $values[] = $id;
            $stmt->execute($values);

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

            $sql = "DELETE FROM $table_name WHERE id =  :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

    }
}