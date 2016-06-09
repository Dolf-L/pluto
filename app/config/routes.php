<?php

use app\library\Config;

Config::set('routes', array(
    'list' => 'listOfStudents/index', //actionIndex in ListOfStudentsController
    '' => 'listOfStudents/index', //actionIndex in ListOfStudentsController
    'list/delete/([0-9]+)' => 'listOfStudents/delete/$1', //actionDelete in ListOfStudentsController
    'list/addNewStudent' => 'listOfStudents/addNew', //actionAddNewStudent in ListOfStudentsController
    'list/UpdateStudent/([0-9]+)' => 'listOfStudents/Update/$1', //actionUpdateStudent in ListOfStudentsController
));



