<?php

namespace Tests\Fixtures\Models;

use Tests\Fixtures\AbstractModel;
use Tests\Fixtures\Presenters\UserPresenter;
use KennedyTedesco\Presenter\PresentableTrait;
use KennedyTedesco\Presenter\Interfaces\PresentableInterface;

class UserModel extends AbstractModel implements PresentableInterface
{
    use PresentableTrait;

    /**
     * Return the presenter class.
     *
     * @return mixed
     */
    protected function presenter()
    {
        return UserPresenter::class;
    }
}
