<?php

namespace Tests;

use Tests\Fixtures\Model;
use PHPUnit\Framework\TestCase;
use Tests\Fixtures\UserPresenter;
use Illuminate\Support\Collection;

class PresenterTest extends TestCase
{
    public function testSingleModel()
    {
        $user = new Model([
            'name' => 'Kennedy Tedesco Parreira',
        ]);

        $userPresenter = new UserPresenter($user);

        $this->assertEquals('Kennedy', $userPresenter->firstName);
        $this->assertEquals('Parreira', $userPresenter->lastName);

        $this->assertEquals('Kennedy', $userPresenter->firstName());
        $this->assertEquals('Parreira', $userPresenter->lastName());

        $this->assertNull($userPresenter->surName);
    }

    public function testCollection()
    {
        $collection = new Collection([
            new Model([
                'name' => 'Kennedy Tedesco Parreira',
            ]),
            new Model([
                'name' => 'Foo Bar',
            ])
        ]);

        $users = presenter($collection, new UserPresenter);

        $this->assertEquals('Kennedy', $users->first()->firstName);
        $this->assertEquals('Parreira', $users->first()->lastName);

        $this->assertEquals('Foo', $users->last()->firstName);
        $this->assertEquals('Bar', $users->last()->lastName);
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testCallInvalidMethod()
    {
        $user = new Model([
            'name' => 'Kennedy Tedesco Parreira',
        ]);

        $userPresenter = new UserPresenter($user);

        $this->assertEquals(true, $userPresenter->isAdmin());
    }
}
