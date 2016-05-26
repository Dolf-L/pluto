<?php
return array(
    // Main page
    'list' => 'listOfStudents/index', //actionIndex in ListOfStudentsController
    '' => 'listOfStudents/index', //actionIndex in ListOfStudentsController
    // Deleting
    'list/delete/([0-9]+)' => 'listOfStudents/delete/$1', //actionDelete in ListOfStudentsController
    // Adding new
    'list/addNewStudent' => 'listOfStudents/addNewStudent', //actionAddNewStudent in ListOfStudentsController
    // Updating data
    'list/UpdateStudent/([0-9]+)' => 'listOfStudents/UpdateStudent/$1', //actionUpdateStudent in ListOfStudentsController
);