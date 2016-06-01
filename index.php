<?php
use app\library\Router;

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));

require_once ROOT . "/vendor/autoload.php";
require_once ROOT . "/vendor/twig/twig/lib/Twig/Autoloader.php";
Twig_Autoloader::register();

$router = new Router();
$router->run();
