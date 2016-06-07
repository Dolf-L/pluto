<?php

namespace app\interfaces;

/**
 * Interface IOrderRepositoryInject
 *
 * @package app\interfaces
 */
interface IRepositoryInject
{
    public function setRepository(IModel $repository);
}