<?php
namespace app\controllers;

use app\library\Db;
use app\library\Error;
use app\library\Model;
use app\library\View;
use app\library\Filtration;
use app\model\ListOfStudents;
use app\validation\Validation;
use app\library\Controller;
use app\library\Config;

class ListOfStudentsController extends Controller
{
    protected $model;
    protected $valid_params;
    protected $error;


    public function __construct()
    {
        $params = Config::get('db_params');
        $this->model = new ListOfStudents(new Db(), $params, new Filtration(), 'list');
        $this->model->setRepository(new Model(new Db(), $params));
    }

    public function actionIndex()
    {
        new View('index.html.twig', array('list' => $this->model->getStudentsList()));
        echo Error::showError('valid_error');
    }
    public function actionDelete($id)
    {
        $this->model->deleteStudent($id);
        header("Location: /list");
    }
    public function actionAddNewStudent()
    {
        new Validation($_POST, $this->valid_params);
        new View('add.html.twig');
        $this->model->AddNewStudent($_POST);
        if ($_POST) {
            header("Location: /list");
        }
    }
    public function actionUpdateStudent($id)
    {
        new Validation($_POST, $this->valid_params);
        new View('update.html.twig', array('one' => $this->model->getOneStudent($id)));
        $this->model->UpdateStudent($_POST, $id);
        if ($_POST) {
            header("Location: /list");
        }
    }
}