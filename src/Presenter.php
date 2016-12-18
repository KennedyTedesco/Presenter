<?php

namespace KennedyTedesco\Presenter;

use KennedyTedesco\Presenter\Exceptions\PresenterException;
use KennedyTedesco\Presenter\Interfaces\PresenterInterface;
use KennedyTedesco\Presenter\Interfaces\PresentableInterface;

abstract class Presenter implements PresenterInterface
{
    /**
     * @var object
     */
    protected $model;

    /**
     * Presenter constructor.
     * @param $model
     *
     * @throws PresenterException
     */
    public function __construct($model)
    {
        if (! is_object($model)) {
            throw new PresenterException("You must pass an object to the presenter " . get_class($this));
        }

        $this->model = $model;
    }

    /**
     * @param $property
     * @return mixed
     *
     * @throws PresenterException
     */
    public function __get($property)
    {
        $getter = 'get' . ucfirst($property);

        if (method_exists($this, $property)) {
            return $this->decorate($this->$property());
        } elseif (method_exists($this, $getter)) {
            return $this->decorate($this->$getter());
        }

        return $this->decorate($this->model->$property);
    }

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     *
     * @throws PresenterException
     */
    public function __call($method, $arguments)
    {
        if (method_exists($this, $method)) {
            return $this->decorate($this->$method(...$arguments));
        }

        throw new PresenterException("Unknown method '{$method}' on '".get_class($this)."'");
    }

    /**
     * @param $value
     * @return mixed
     */
    private function decorate($value)
    {
        if ($value instanceof PresenterInterface) {
            return $value;
        } elseif ($value instanceof PresentableInterface) {
            return $value->present();
        }

        return $value;
    }
}
