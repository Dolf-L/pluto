<?php
namespace app\controllers;

use app\library\View;
use app\model\ListOfStudents;
use app\model\Validation;
use app\library\Controller;

class ListOfStudentsController extends Controller
{
    public function __construct()
    {
        $this->model = new ListOfStudents();
    }

    public function actionIndex()
    {
        new View('index.html.twig', array('list' => $this->model->getStudentsList()));
    }
    public function actionDelete($id)
    {
        $this->model->deleteStudent($id);
        header("Location: /list");
    }
    public function actionAddNewStudent()
    {
        new View('add.html.twig');
    }

    public function actionAdd()
    {
        new Validation($_POST, 15, 90, 2, 255);
        $this->model->AddNewStudent($_POST);
        if (isset($_POST['name'])) {
            header("Location: /list");
        }
    }

    public function actionUpdateStudent($id)
    {
        new Validation($_POST, 15, 90, 2, 255);
        new View('update.html.twig', array('one' => $this->model->getOneStudent($id)));

    }
    public function actionUpdate($id)
    {
        new Validation($_POST, 15, 90, 2, 255);
        $this->model->UpdateStudent($_POST, $id);
        if (isset($_POST['name'])) {
            header("Location: /list");
        }
    }
}