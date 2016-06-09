<?php
namespace app\model;

use app\validation\IFiltration;
use app\database\IModel;
use app\library\BaseModel;


class ListOfStudents extends BaseModel
{
    public $db;

    public $table_name;

    public $filter;

    public $model;

    /**
     * ListOfStudents constructor.
     *
     * @param $table_name
     */
    public function __construct($table_name)
    {
        $this->table_name = $table_name;
    }

    /**
     * Filter for data
     *
     * @param IFiltration $filter
     */
    public function setFiltration(IFiltration $filter)
    {
        $this->filter = $filter;
    }

    /**
     * Set connection to specific Db
     *
     * @param IModel $model
     */
    public function setModel(IModel $model)
    {
        $this->model = $model;
    }

    /**
     * Get list of students
     *
     * @return mixed
     */
    public function getStudentsList()
    {
        return $this->model->view($this->table_name);
    }

    /**
     * get info for one student
     *
     * @param $id
     * @return mixed
     */
    public function getOneStudent($id)
    {
        return $this->model->search($this->table_name, $id);
    }

    /**
     * Add new student
     *
     * @param $data
     */
    public function AddNewStudent($data)
    {
        $data = $this->filter->filter($data);
        $this->model->add($this->table_name, $data);
    }

    /**
     * Update student info by id
     *
     * @param $data
     * @param $id
     */
    public function UpdateStudent($data, $id)
    {
        $data = $this->filter->filter($data);
        $this->model->update($this->table_name, $data, $id);
    }

    /**
     * delete student by id
     *
     * @param $id
     */
    public function deleteStudent($id)
    {
        $this->model->delete($this->table_name, $id);
    }
}