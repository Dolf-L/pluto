<?php
use app\library\Router;
use app\library\Config;

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));

require_once ROOT . "/vendor/autoload.php";

$routes = Config::get('routes');

$router = new Router($routes);
$router->run();

