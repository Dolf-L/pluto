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
        new View('index.html', array('list' => $this->model->getStudentsList()));
//        $list =  $this->model->getStudentsList();
//        require_once ROOT . '/app/view/index.php';
    }
    public function actionDelete($id)
    {
        $this->model->deleteStudent($id);
        header("Location: /list");
    }
    public function actionAddNewStudent()
    {
        new Validation($_POST, 15, 90, 2, 255);
        require_once ROOT . '/app/view/add.php';
        $this->model->AddNewStudent($_POST);
        if (isset($_POST['name'])) {
            header("Location: /list");
        }
    }
    public function actionUpdateStudent($id)
    {
        new Validation($_POST, 15, 90, 2, 255);
        $one = $this->model->getOneStudent($id);
        require_once ROOT . '/app//view/update.php';

        $this->model->UpdateStudent($_POST, $id);

        if (isset($_POST['name'])) {
            header("Location: /list");
        }
    }
}