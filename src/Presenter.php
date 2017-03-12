<?php

namespace KennedyTedesco\Presenter;

use BadMethodCallException;

abstract class Presenter implements PresenterInterface
{
    /**
     * @var mixed
     */
    protected $object;

    /**
     * BasePresenter constructor.
     * @param null $object
     */
    public function __construct($object = null)
    {
        if ($object) {
            $this->set($object);
        }
    }

    /**
     * @param $object
     * @return $this
     */
    public function set($object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        if (method_exists($this, $key)) {
            return $this->$key();
        }

        return $this->object->$key;
    }

    /**
     * @param $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, array $arguments)
    {
        if (method_exists($this, $name)) {
            return $this->$name(...$arguments);
        } elseif (method_exists($this->object, $name)) {
            return $this->object->$name(...$arguments);
        }

        throw new BadMethodCallException("Method {$name} does not exist.");
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->object->$name);
    }
}
