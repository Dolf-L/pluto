<?php
namespace app\library;

/**
 * Class BaseView
 *
 * @package app\library
 */
class BaseView
{
    public function __construct($index = '', $data = array())
    {
        $loader = new \Twig_Loader_Filesystem('app/view');
        $twig = new \Twig_Environment($loader, array());

        echo $twig->render($index, $data);
    }

}