<?php

namespace Tests\Fixtures\Presenters;

use KennedyTedesco\Presenter\Presenter;

class UserPresenter extends Presenter
{
    /**
     * @return mixed
     */
    public function firstName()
    {
        return strtok($this->model->name, ' ');
    }

    /**
     * @return mixed
     */
    public function lastName()
    {
        return array_slice(explode(' ', $this->model->name), -1)[0];
    }

    /**
     * @return int
     */
    public function fullName()
    {
        return $this->model->name;
    }
}
