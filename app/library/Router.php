<?php
namespace app\library;


use app\controllers\ListOfStudentsController;


class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';

        // Отримуєм роути з файлу
        $this->routes = include($routesPath);
    }

    // Отримуєм URI

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
//        echo "routs: <pre>";
//        var_dump($this->routes);
//        echo '</pre>';
        // Отримуєм строку запиту
        $uri = $this->getURI();
//        echo "URI: <pre>";
//        var_dump($uri);
//        echo '</pre>';
        // Перевіряєм співпадіння запиту і елемента з масиву роутів  (routes.php)
        foreach ($this->routes as $uriPattern => $path) {

            // Порівнюєм $uriPattern і $uri
            if (preg_match("~^$uriPattern$~", $uri)) {
//                echo "uriPattern: <pre>";
//                var_dump($uriPattern);
//                echo '</pre>';

                // Отримуєм внутрішній шлях із УРІ згідно правила з масиву роутів
                $internalRoute = preg_replace("~^$uriPattern$~", $path, $uri);
//                echo "internalRouts: <pre>";
//                var_dump($internalRoute);
//                echo '</pre>';
                // Визначаєм який контроллер і метод обробляють запит + параметри метода

                $segments =  explode('/', $internalRoute);
                $controllerName = ucfirst(array_shift($segments)) . 'Controller';
                $actionName = 'action' . ucfirst(array_shift($segments));
                $parameters = $segments;

                // Подключить файл класса-контроллера
                $controllerFile = ROOT . '/controllers/' .
                    $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                // Створюєм об’єкт, викликаєм метод

                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if ($result != NULL) {
                    break;
                }

            }
        }
    }
}