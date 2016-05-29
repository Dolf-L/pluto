<?php
namespace app\library;


abstract class Controller
{

    protected $model;

    abstract function actionIndex();

}