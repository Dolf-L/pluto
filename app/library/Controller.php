<?php
namespace app\library;


abstract class Controller
{
    protected $model;

    protected $valid_params;

    abstract function actionIndex();

    abstract function actionDelete($id);

    abstract function actionAddNewStudent();

    abstract function actionUpdateStudent($id);
}