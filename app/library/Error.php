<?php
namespace app\library;



class Error {

    protected $errors = array();

    public function __construct($error)
    {
        $this->errors[] = $error;
    }
}