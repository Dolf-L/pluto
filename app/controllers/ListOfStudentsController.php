<?php
namespace app\controllers;

use app\library\BaseController;
use app\library\Config;
use app\library\ErrorHandler;
use app\model\ListOfStudents;
use app\validation\Filtration;
use app\database\PDOModel;
use app\library\BaseView;
use app\validation\Validation;

class ListOfStudentsController extends BaseController
{
    protected $model;

    protected $valid_params;

    public function __construct()
    {
        $this->valid_params = Config::get('valid_params');
        $this->model = new ListOfStudents('list');
        $this->model->setFiltration(new Filtration());
        $this->model->setModel(new PDOModel());
    }

    public function actionIndex()
    {

        new BaseView('index.html.twig', array('list' => $this->model->getStudentsList()));
        echo ErrorHandler::showError('valid_error');
    }

    public function actionAddNew()
    {
        new Validation($_POST, $this->valid_params);
        new BaseView('add.html.twig');
        $this->model->AddNewStudent($_POST);
        if ($_POST) {
            header("Location: /list");
        }
    }

    public function actionUpdate($id)
    {

        new Validation($_POST, $this->valid_params);
        new BaseView('update.html.twig', array('one' => $this->model->getOneStudent($id)));
        $this->model->UpdateStudent($_POST, $id);
        if ($_POST) {
            header("Location: /list");
        }
    }

    public function actionDelete($id)
    {
        $this->model->deleteStudent($id);
        header("Location: /list");
    }
}