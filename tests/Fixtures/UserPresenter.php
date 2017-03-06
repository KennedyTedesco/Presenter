<?php

namespace Tests\Fixtures;

use KennedyTedesco\Presenter\Presenter;

class UserPresenter extends Presenter
{
    /**
     * @return mixed
     */
    public function firstName()
    {
        return strtok($this->object->name, ' ');
    }

    /**
     * @return mixed
     */
    public function lastName()
    {
        return array_slice(explode(' ', $this->object->name), -1)[0];
    }

    /**
     * @return int
     */
    public function fullName()
    {
        return $this->object->name;
    }
}
