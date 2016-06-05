<?php
namespace app\validation;

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
        try {
            foreach ($el as $element) {
                if (empty($element)) {
                    throw new \ErrorException("Please fill out this field");
                } elseif (is_numeric($element)) {
                    if ((intval($element) != $element)) {
                        throw new \ErrorException("Age mast be integer number");
                    }
                    if ($element < $min_num) {
                        throw new \ErrorException("Age mast be grater than $min_num");
                    }
                    if ($element > $max_num) {
                        throw new \ErrorException("Age mast be less than $max_num");
                    }
                } elseif (is_string($element)) {
                    if ((strlen($element) < $min_str_len)) {
                        throw new \ErrorException("There must be at list $min_str_len character long");
                    }
                    if ((strlen($element) > $max_str_len)) {
                        throw new \ErrorException("There must be less than $max_str_len character");
                    }
                } else {
                    throw new \ErrorException('Please fill out this field correctly');
                }
            }
        } catch (\ErrorException $e) {
            Error::logError('valid_error', $e->getMessage());
            header("Location: /list/addNewStudent");
            exit;
        }
    }

}