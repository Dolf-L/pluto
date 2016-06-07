<?php
namespace app\model;

use app\interfaces\IDb;
use app\interfaces\IFiltration;
use app\interfaces\IModel;
use app\interfaces\IRepositoryInject;


class ListOfStudents
{
    public $db;
    public $table_name;
    public $filter;
    public $repository;

    public function __construct(IDb $db, $params, IFiltration $filter, $table_name)
    {
        $this->db = $db->getConnection($params);
        $this->table_name = $table_name;
        $this->filter = $filter;
    }

    public function setRepository(IModel $repository)
    {
        $this->repository = $repository;
    }

    public function getStudentsList()
    {
        return $this->repository->view($this->table_name);
    }

    public function getOneStudent($id)
    {
        return $this->repository->search($this->table_name, $id);
    }

    public function deleteStudent($id)
    {
        $this->repository->delete($this->table_name, $id);
    }

    public function AddNewStudent($data)
    {
        $data = $this->filter->filter($data);
        $this->repository->add($this->table_name, $data);
    }

    public function UpdateStudent($data, $id)
    {
        $data = $this->filter->filter($data);
        $this->repository->update($this->table_name, $data, $id);
    }
}