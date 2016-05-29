<?php
use app\library\Router;
use app\library\Error;

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));

require_once ROOT . "/vendor/autoload.php";

$router = new Router();
$router->run();
