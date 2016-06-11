<?php
namespace app\library;

use app\database\Db;
use app\database\IModel;

/**
 * Base model
 *
 * abstract class, describes major actions which must contain every model
 */
abstract class BaseModel
{
    /*
     * Db connection
     */
    protected $db;

    /*
     * Name of table in db
     */
    protected $table_name;

    /**
     * Instance of model
     */
    protected $model;

    /**
     * BaseModel constructor.
     *
     * @param $table_name
     */
    public function __construct()
    {
        $this->db = Db::getConnection();
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
     * Show data
     *
     * show all data from database
     *
     * @param $table_name
     * @return array
     */
    public function view()
    {
        return $this->model->view($this->table_name);
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
    public function search($id)
    {
        return $this->model->search($this->table_name, $id);
    }

    /**
     * Add new
     *
     * Add new data to database
     *
     * @param $table_name
     * @param $data
     */
    public function add($data)
    {
        $this->model->add($this->table_name, $data);
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
    public function update($data, $id)
    {
        $this->model->update($this->table_name, $data, $id);
    }

    /**
     * Delete
     *
     * delete data from database by id
     *
     * @param $table_name
     * @param $id
     */
    public function delete($id)
    {
        $this->model->delete($this->table_name, $id);
    }
}