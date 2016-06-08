<?php

namespace app\interfaces;

/**
 * Interface IModel define methods base model mast have
 *
 * @package app\interfaces
 */
interface IModel
{
    /**
     * IModel constructor.
     */
    public function __construct();

    /**
     * Show data
     *
     * show all data from database
     *
     * @param $table_name
     * @return array
     */
    public function view($table_name);

    /**
     * Search
     *
     * pick one string from database by id
     *
     * @param $table_name
     * @param $id
     * @return array
     */
    public function search($table_name, $id);

    /**
     * Add new
     *
     * Add new data to database
     *
     * @param $table_name
     * @param $data
     */
    public function add($table_name, $data);

    /**
     * Update data
     *
     * update data in database
     *
     * @param $table_name
     * @param $data
     * @param $id
     */
    public function update($table_name, $data, $id);

    /**
     * Delete
     *
     * delete data from database by id
     *
     * @param $table_name
     * @param $id
     */
    public function delete($table_name, $id);
}