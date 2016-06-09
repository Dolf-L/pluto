<?php
namespace app\validation;


/**
 * Class Filtration
 *
 * @package app\validation
 */
class Filtration implements IFiltration
{
    protected $array = array();

    /**
     * Data filter
     *
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
                Error::logError('filter','incorrect type');
            }
        }
        return $this->array;
    }

    /**
     * Numeric filter
     *
     * @param $num
     * @return string
     */
    public function ifNum($num)
    {
        return strip_tags((int)$num);
    }

    /**
     * String filter
     *
     * @param $str
     * @return string
     */
    public function ifStr($str)
    {
        return trim(strip_tags($str));
    }
}