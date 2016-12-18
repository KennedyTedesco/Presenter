<?php

namespace KennedyTedesco\Presenter\Interfaces;

interface PresenterInterface
{
    /**
     * @param $property
     * @return mixed
     */
    public function __get($property);

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public function __call($method, $arguments);
}
