<?php
namespace app\model;

use app\library\Error;

class Filtration
{
    protected $array = array();

    /**
     * @param $array
     * @return Error|array
     */
    public function filter($array)
    {
        foreach ($array as $key => $value) {
            if (is_numeric($value)) {
                $this->array[$key] = $this->ifNum($value);
            } elseif (is_string($value)) {
                $this->array[$key] = $this->ifStr($value);
            } else {
                return new Error("incorrect data type");
            }
        }
        return $this->array;
    }

    public function ifNum($num)
    {
        return strip_tags((int)$num);
    }

    public function ifStr($str)
    {
        return trim(strip_tags($str));
    }
}