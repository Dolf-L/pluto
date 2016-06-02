<?php
namespace app\library;



class Error {

    protected $errors;

    public function __construct($error)
    {
        $this->errors = $error;
    }
}