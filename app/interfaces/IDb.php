<?php

namespace app\interfaces;

/**
 * Interface IDb
 *
 * @package app\interfaces
 */
interface IDb
{
    /**
     * Interface connection
     *
     * declare connection to database
     *
     * @param $params
     * @return mixed
     */
    public function getConnection($params);
}