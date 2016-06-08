<?php
namespace app\library;

use app\interfaces\IFiltration;

class Filtration implements IFiltration
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
                Error::logError('filter','incorrect type');
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