<?php
namespace app\model;

use app\library\Error;

class Validation
{
    /**
     * Validation constructor.
     * @param $el
     * @param $min_num
     * @param $max_num
     * @param $min_str_len
     * @param $max_str_len
     */
    public function __construct($el, $min_num, $max_num, $min_str_len, $max_str_len)
    {
        foreach ($el as $element) {
            if (is_numeric($element) && !empty($element)) {
                if ((intval($element) != $element) || ($element < $min_num) || ($element > $max_num)) {
                    $this->errors();
                }
            } elseif (is_string($element) && !empty($element)) {
                if ((strlen($element) < $min_str_len) || (strlen($element) > $max_str_len)) {
                    $this->errors();
                }
            } else {
                $this->errors();
            }
        }
    }
    public function errors()
    {
        new Error('wrong data');
        header("Location: /list");
        exit;
    }
}