<?php

namespace Hellcat\TwitchApiBundle\Model;

/**
 * Class Factory
 * @package Hellcat\TwitchApiBundle\Model
 */
class Factory
{
    /**
     * @var array
     */
    private $factory;

    /**
     * Factory constructor.
     */
    public function __construct()
    {
        $this->factory = [];
    }

    /**
     * @return Twitch\Factory
     */
    public function twitch()
    {
        if (!isset($this->factory[__FUNCTION__])) {
            $this->factory[__FUNCTION__] = new Twitch\Factory();
        }
        return $this->factory[__FUNCTION__];
    }
}
