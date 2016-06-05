<?php
namespace app\controllers;

use app\library\Db;
use app\library\Error;
use app\library\View;
use app\validation\Filtration;
use app\model\ListOfStudents;
use app\validation\Validation;
use app\library\Controller;

class ListOfStudentsController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new ListOfStudents(new Db(), 'list', new Filtration());
    }

    public function actionIndex()
    {
        new View('index.html.twig', array(
            'list' => $this->model->getStudentsList()));
    }
    public function actionDelete($id)
    {
        $this->model->deleteStudent($id);
        header("Location: /list");
    }
    public function actionAddNewStudent()
    {
        new Validation($_POST, 15, 90, 2, 20);
        new View('add.html.twig', array('errors' => Error::showError()));
        $this->model->AddNewStudent($_POST);

//        if ($_POST) {
//            header("Location: /list");
//        }
    }
    public function actionUpdateStudent($id)
    {
        new Validation($_POST, 15, 90, 2, 20);
        new View('update.html.twig', array('one' => $this->model->getOneStudent($id), 'errors' => Error::showError()));
        $this->model->UpdateStudent($_POST, $id);
        if ($_POST) {
            header("Location: /list");
        }
    }
}