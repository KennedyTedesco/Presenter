<?php

use PHPUnit\Framework\TestCase;

use Tests\Fixtures\Models\UserModel;
use Tests\Fixtures\Models\ArticleModel;
use Tests\Fixtures\Presenters\ArticlePresenter;
use Tests\Fixtures\Presenters\PublishedArticlePresenter;

class PresenterTest extends TestCase
{
    public function testGetProperties()
    {
        $user = new UserModel([
            'name' => 'Kennedy Tedesco Parreira',
        ]);

        $this->assertEquals('Kennedy', $user->present()->firstName);
        $this->assertEquals('Parreira', $user->present()->lastName);

        $this->assertEquals('Kennedy', $user->present()->firstName());
        $this->assertEquals('Parreira', $user->present()->lastName());

        $this->assertNull($user->present()->surName);
    }

    /**
     * @expectedException \KennedyTedesco\Presenter\Exceptions\PresenterException
     */
    public function testCallInvalidMethod()
    {
        $user = new UserModel([
            'name' => 'Kennedy Tedesco Parreira',
        ]);

        $this->assertEquals(true, $user->present()->isAdmin());
    }

    public function testPresenterInstance()
    {
        $article = new ArticleModel([
            'title' => 'PHP 7.1 features',
            'published' => false,
        ]);

        $this->assertEquals('PHP 7.1 features', $article->present()->title);
        $this->assertEquals('2016-12-18', $article->present()->createdAt);

        $this->assertInstanceOf(ArticlePresenter::class, $article->present());
        $this->assertNull($article->present()->countViews);

        // The 'published' set to true will force to use another presenter type
        $article = new ArticleModel([
            'title' => 'PHP 7.1 features',
            'published' => true,
        ]);

        $this->assertInstanceOf(PublishedArticlePresenter::class, $article->present());
        $this->assertEquals(100, $article->present()->countViews);
    }
}
