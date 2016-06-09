<?php
namespace app\library;

/**
 * Class Router
 *
 * @package app\library
 */
class Router
{
    private $routes;

    /**
     * Router constructor.
     *
     * @param $routes
     */
    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    /**
     * Get URL
     *
     * @return string
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /**
     * Run router
     */
    public function run()
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {

            if (preg_match("~^$uriPattern$~", $uri)) {

                $internalRoute = preg_replace("~^$uriPattern$~", $path, $uri);

                $segments =  explode('/', $internalRoute);
                $controllerName = 'app\controllers\\' . ucfirst(array_shift($segments)) . 'Controller';
                $actionName = 'action' . ucfirst(array_shift($segments));
                $parameters = $segments;
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if ($result != NULL)  break;
            }
        }
    }
}