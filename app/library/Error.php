<?php
namespace app\library;



class Error {
    private $msg;
    public function __construct($msg) {
        $this->msg = $msg;
    }
    public function __toString() {
        return $this->msg;
    }
}