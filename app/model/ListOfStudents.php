<?php
namespace app\model;

use app\interfaces\IFiltration;
use app\interfaces\IModel;


class ListOfStudents
{
    public $db;
    public $table_name;
    public $filter;
    public $model;

    public function __construct($table_name)
    {
        $this->table_name = $table_name;
    }

    public function setFiltration(IFiltration $filter)
    {
        $this->filter = $filter;
    }

    public function setModel(IModel $model)
    {
        $this->model = $model;
    }

    public function getStudentsList()
    {
        return $this->model->view($this->table_name);
    }

    public function getOneStudent($id)
    {
        return $this->model->search($this->table_name, $id);
    }

    public function deleteStudent($id)
    {
        $this->model->delete($this->table_name, $id);
    }

    public function AddNewStudent($data)
    {
        $data = $this->filter->filter($data);
        $this->model->add($this->table_name, $data);
    }

    public function UpdateStudent($data, $id)
    {
        $data = $this->filter->filter($data);
        $this->model->update($this->table_name, $data, $id);
    }
}