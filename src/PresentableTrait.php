<?php

namespace KennedyTedesco\Presenter;

use KennedyTedesco\Presenter\Interfaces\PresentableInterface;
use KennedyTedesco\Presenter\Interfaces\PresenterInterface;
use KennedyTedesco\Presenter\Exceptions\PresenterException;

trait PresentableTrait
{
    /**
     * @var null|PresenterInterface
     */
    private $_presenter;

    /**
     * @return PresenterInterface|null
     * @throws PresenterException
     */
    public function present()
    {
        if ($this->_presenter) {
            return $this->_presenter;
        }

        if ($this instanceof PresentableInterface)) {
            $presenter = new $this->presenter();

            if (! $presenter instanceof PresenterInterface)) {
                throw new PresenterException('You need to set a valid presenter class.');
            }

            return $this->_presenter = new $presenter($this);
        }

        throw new PresenterException('You must set the presenter() method on ' . get_class($this));
    }
}
