<?php

namespace Tests\Fixtures\Models;

use Tests\Fixtures\AbstractModel;
use KennedyTedesco\Presenter\PresentableTrait;
use Tests\Fixtures\Presenters\ArticlePresenter;
use Tests\Fixtures\Presenters\PublishedArticlePresenter;
use KennedyTedesco\Presenter\Interfaces\PresentableInterface;

class ArticleModel extends AbstractModel implements PresentableInterface
{
    use PresentableTrait;

    /**
     * Return the presenter class.
     * @return mixed
     */
    protected function presenter()
    {
        return $this->published ?
            PublishedArticlePresenter::class : ArticlePresenter::class;
    }
}
