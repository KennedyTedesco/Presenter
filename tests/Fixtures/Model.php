<?php

namespace Tests\Fixtures;

class Model
{
    /**
     * @var array
     */
    private $properties = [];

    /**
     * AbstractModel constructor.
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        $this->properties = $properties;
    }

    /**
     * @param $property
     * @return mixed|null
     */
    public function __get($property)
    {
        return $this->properties[$property] ?? null;
    }
}
