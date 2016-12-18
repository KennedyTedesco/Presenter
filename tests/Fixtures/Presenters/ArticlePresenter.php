<?php

namespace Tests\Fixtures\Presenters;

use KennedyTedesco\Presenter\Presenter;

class ArticlePresenter extends Presenter
{
    /**
     * @return mixed
     */
    public function createdAt()
    {
        return '2016-12-18';
    }
}
