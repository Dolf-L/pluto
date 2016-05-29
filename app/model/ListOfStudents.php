<?php
namespace app\model;

use app\library\Model;
use app\library\Db;


class ListOfStudents extends Model
{
    private $table_name = 'list';

    public function __construct()
    {
        $this->db = Db::getConnection();
    }
    public function getStudentsList()
    {
        return $this->view($this->table_name);
    }
    public function getOneStudent($id)
    {
        return $this->search($this->table_name, $id);
    }
    public function deleteStudent($id)
    {
        $this->delete($this->table_name, $id);
    }
    public function AddNewStudent($data)
    {
        $this->add($this->table_name, $data);
    }
    public function UpdateStudent($data, $id)
    {
        $this->update($this->table_name, $data, $id);
    }
}