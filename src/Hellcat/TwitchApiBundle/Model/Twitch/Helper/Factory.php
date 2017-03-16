<?php

namespace Hellcat\TwitchApiBundle\Model\Twitch\Helper;

/**
 * Class Factory
 * @package Hellcat\TwitchApiBundle\Model\Twitch\Helper
 */
class Factory
{
    /**
     * @return Endpoint
     */
    public function endpoint()
    {
        return new Endpoint();
    }
}
