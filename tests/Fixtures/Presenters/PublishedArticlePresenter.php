<?php

namespace Tests\Fixtures\Presenters;

class PublishedArticlePresenter extends ArticlePresenter
{
    /**
     * @return int
     */
    public function countViews()
    {
        return 100;
    }
}
