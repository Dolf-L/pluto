<?php
namespace app\model;

use app\library\Model;
use app\library\Db;

use app\model\Filtration;

class ListOfStudents extends Model
{
    public $db;
    public $table_name;
    public $filter;

    public function __construct(Db $db, $table_name, Filtration $filter)
    {
        $this->db = $db->getConnection();
        $this->table_name = $table_name;
        $this->filter = $filter;

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
        $data = $this->filter->filter($data);
        $this->add($this->table_name, $data);
    }
    public function UpdateStudent($data, $id)
    {
        $data = $this->filter->filter($data);
        $this->update($this->table_name, $data, $id);
    }
}