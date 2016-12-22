<?php

namespace KennedyTedesco\Presenter;

use KennedyTedesco\Presenter\Exceptions\PresenterException;
use KennedyTedesco\Presenter\Interfaces\PresenterInterface;
use KennedyTedesco\Presenter\Interfaces\PresentableInterface;

abstract class Presenter implements PresenterInterface
{
    /**
     * The object that is being decorated.
     *
     * @var object
     */
    protected $object;

    /**
     * Presenter constructor.
     * @param $object
     *
     * @throws PresenterException
     */
    public function __construct($object)
    {
        if (! is_object($object)) {
            throw new PresenterException("You must pass an object to the presenter " . get_class($this));
        }

        $this->object = $object;
    }

    /**
     * @param $property
     * @return mixed
     *
     * @throws PresenterException
     */
    public function __get($property)
    {
        if (method_exists($this, $property)) {
            return $this->decorate($this->$property());
        }

        return $this->decorate($this->object->$property);
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
