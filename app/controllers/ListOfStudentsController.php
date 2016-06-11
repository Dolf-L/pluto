<?php
namespace app\controllers;

use app\library\BaseController;
use app\library\Config;
use app\library\ErrorHandler;
use app\model\ListOfStudents;
use app\library\View;
use app\validation\Validation;
use app\library\DI;


/**
 * Class ListOfStudentsController
 *
 * @package app\controllers
 */
class ListOfStudentsController extends BaseController
{
    /**
     * @var ListOfStudents
     */
    protected $model;

    /**
     * Validation parameters from config
     */
    protected $valid_params;

    /**
     *
     */
    protected $view;

    /**
     * ListOfStudentsController constructor.
     */
    public function __construct()
    {
        $this->valid_params = Config::get('valid_params');
        $this->model = DI::getInstanceOf('app\model\ListOfStudents', 'list');
    }

    /**
     * Show mane view
     */
    public function actionIndex()
    {
        new View('index.html.twig', array('list' => $this->model->getStudentsList()));
        echo ErrorHandler::showError('valid_error');
    }

    /**
     * Show view of adding student
     */
    public function actionAddNew()
    {
        new Validation($_POST, $this->valid_params);
        new View('add.html.twig');
        $this->model->AddNewStudent($_POST);
        if ($_POST) {
            header("Location: /list");
        }
    }

    /**
     * Show view of updating student
     *
     * @param $id
     */
    public function actionUpdate($id)
    {
        new Validation($_POST, $this->valid_params);
        new View('update.html.twig', array('one' => $this->model->getOneStudent($id)));
        $this->model->UpdateStudent($_POST, $id);
        if ($_POST) {
            header("Location: /list");
        }
    }

    /**
     * Deleting student by id
     *
     * @param $id
     */
    public function actionDelete($id)
    {
        $this->model->deleteStudent($id);
        header("Location: /list");
    }
}