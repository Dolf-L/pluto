<?php

use app\library\Config;

Config::set('db_params', array(
    'host'     => '127.0.0.1',
    'dbname'   => 'db_students',
    'user'     => 'root',
    'password' => '1715',
    'charset'  => 'utf8',
    'options'  => array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
)));