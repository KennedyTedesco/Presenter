<?php

use KennedyTedesco\Presenter\Manager;
use KennedyTedesco\Presenter\PresenterInterface;

if (! function_exists('presenter')) {
    /**
     * @param $models
     * @param PresenterInterface $presenter
     * @return mixed
     */
    function presenter($models, PresenterInterface $presenter)
    {
        return Manager::factory($models, $presenter);
    }
}
