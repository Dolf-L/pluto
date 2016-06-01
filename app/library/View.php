<?php
namespace app\library;


class View
{
    public function __construct($index = 'base.html.twig', $data = array())
    {
        $loader = new \Twig_Loader_Filesystem('app/view');
        $twig = new \Twig_Environment($loader, array());

//        $lexer = new \Twig_Lexer($twig, array(
//           'tag_block'     => array('{', '}'),
//           'tag_variable'  => array('{{', '}}'),
//        ));
//
//        $twig->setLexer($lexer);

        echo $twig->render($index, $data);
    }

}