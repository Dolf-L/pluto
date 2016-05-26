<?php
namespace app\controllers;

use app\model\ListOfStudents;

class ListOfStudentsController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ListOfStudents();
    }

    public function actionIndex()
    {
        $list =  $this->model->getStudentsList();
        require_once ROOT . '/view/index.php';
    }
    public function actionDelete($id)
    {
        $this->model->deleteStudent($id);

        header("Location: /list");
    }
    public function actionAddNewStudent()
    {
        $this->model->AddNewStudent($_POST);
        require_once ROOT . '/view/add.php';
        if (isset($_POST['name'])) {
            header("Location: /list");
        }
    }
    public function actionUpdateStudent($id)
    {
        $this->model->UpdateStudent($_POST, $id);
        $one = $this->model->getOneStudent($id);

        require_once ROOT . '/view/update.php';
        if (isset($_POST['name'])) {
            header("Location: /list");
        }
    }
}