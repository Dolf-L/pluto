<?php
namespace app\library;

/**
 * abstract Class BaseController
 *
 * @package app\library
 */
abstract class BaseController
{
    protected $model;

    /**
     * index View instance
     */
    abstract function actionIndex();

    /**
     * Add View instance
     * Validation instance
     * use AddNew model
     */
    abstract function actionAddNew();

    /**
     * Update View instance
     * Validation instance
     * use Update model
     *
     * @param $id
     */
    abstract function actionUpdate($id);

    /**
     * Delete part of information by id
     *
     * @param $id
     */
    abstract function actionDelete($id);
}