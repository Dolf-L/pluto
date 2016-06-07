<?php
namespace app\validation;

use app\library\Error;

class Validation
{
    /**
     * Validation constructor.
     *
     * @param $method
     * @param $valid_params
     */
    public function __construct($method, $valid_params)
    {
        try {
            foreach ($method as $element) {
                if (empty($element)) {
                    throw new \ErrorException("Please fill out this field");
                } elseif (is_numeric($element)) {
                    if ((intval($element) != $element)) {
                        throw new \ErrorException("Age mast be integer number");
                    }
                    if ($element < $valid_params['min_num']) {
                        throw new \ErrorException("Age mast be grater than " . $valid_params['min_num']);
                    }
                    if ($element > $valid_params['max_num']) {
                        throw new \ErrorException("Age mast be less than $" . $valid_params['max_num']);
                    }
                } elseif (is_string($element)) {
                    if ((strlen($element) < $valid_params['min_str_len'])) {
                        throw new \ErrorException("There must be at list " .  $valid_params['min_str_len'] . " character long");
                    }
                    if ((strlen($element) > $valid_params['max_str_len'])) {
                        throw new \ErrorException("There must be less than " . $valid_params['max_str_len'] .  " character");
                    }
                } else {
                    throw new \ErrorException('Please fill out this field correctly');
                }
            }
        } catch (\ErrorException $e) {
            Error::logError('valid_error', $e->getMessage());
            header("Location: /list");
            exit;
        }
    }

}