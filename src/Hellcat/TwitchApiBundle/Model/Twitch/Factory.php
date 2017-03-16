<?php

namespace Hellcat\TwitchApiBundle\Model\Twitch;

/**
 * Class Factory
 * @package Hellcat\TwitchApiBundle\Model\Twitch
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
     * @return Auth\Factory
     */
    public function auth()
    {
        if (!isset($this->factory[__FUNCTION__])) {
            $this->factory[__FUNCTION__] = new Auth\Factory();
        }
        return $this->factory[__FUNCTION__];
    }

    /**
     * @return Helper\Factory
     */
    public function helper()
    {
        if (!isset($this->factory[__FUNCTION__])) {
            $this->factory[__FUNCTION__] = new Helper\Factory();
        }
        return $this->factory[__FUNCTION__];
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
