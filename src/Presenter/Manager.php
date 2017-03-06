<?php

namespace KennedyTedesco\Presenter;

use Illuminate\Support\Collection;

final class Manager
{
    /**
     * @param $models
     * @param PresenterInterface $presenter
     * @return mixed
     */
    public static function factory($models, PresenterInterface $presenter)
    {
        $models = self::normalize($models);

        if ($models instanceof Collection) {
            return $models->transform(function ($object) use ($presenter) {
                return self::getPresenter($object, $presenter);
            });
        }

        return self::getPresenter($models, $presenter);
    }

    /**
     * @param $model
     * @param PresenterInterface $presenter
     * @return mixed
     */
    protected static function getPresenter($model, PresenterInterface $presenter)
    {
        return (clone $presenter)->set($model);
    }

    /**
     * @param $models
     * @return Collection
     */
    protected static function normalize($models)
    {
        if (is_array($models)) {
            return new Collection($models);
        }

        return $models;
    }
}
