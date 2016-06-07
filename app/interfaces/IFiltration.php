<?php

namespace app\interfaces;

/**
 * Interface IFiltration
 *
 * @package app\interfaces
 */
interface IFiltration
{
    /**
     * interface of filter
     *
     * @param $array
     * @return array
     */
    public function filter($array);

    /**
     * interface of filter of numeric values
     *
     * @param $num
     * @return mixed
     */
    public function ifNum($num);

    /**
     * interface of filter of string values
     *
     * @param $str
     * @return mixed
     */
    public function ifStr($str);
}
