<?php

namespace Hellcat\TwitchApiBundle\Twitch\Api;

use Hellcat\TwitchApiBundle\Twitch\Twitch;

/**
 * Class Factory
 * @package Hellcat\TwitchApiBundle\Twitch\Api
 */
class Factory
{
    /**
     * @var array
     */
    private $factory;

    /**
     * @var Twitch
     */
    private $twMan;

    /**
     * Factory constructor.
     * @param Twitch $twMan
     */
    public function __construct(Twitch $twMan)
    {
        $this->factory = [];
        $this->twMan = $twMan;
    }

    /**
     * @return Auth
     */
    public function auth()
    {
        if (!isset($this->factory[__FUNCTION__])) {
            $this->factory[__FUNCTION__] = new Auth(
                $this->twMan->getConfig(),
                $this->twMan->getHttpClient(),
                $this->twMan->getSerializer(),
                $this->twMan->helper()->communication()
            );
        }
        return $this->factory[__FUNCTION__];
    }
}
