<?php

namespace Hellcat\Tools\UserBundle\Entity;

/**
 * Class Factory
 * @package Hellcat\Tools\UserBundle\Entity
 */
class Factory
{
    /**
     * @var array
     */
    private $factory;

    /**
     * Manager constructor.
     */
    public function __construct()
    {
        $this->factory = [];
    }

    /**
     * @return User\Factory
     */
    public function user()
    {
        if (!isset($this->factory[__FUNCTION__])) {
            $this->factory[__FUNCTION__] = new User\Factory();
        }
        return $this->factory[__FUNCTION__];
    }
}
