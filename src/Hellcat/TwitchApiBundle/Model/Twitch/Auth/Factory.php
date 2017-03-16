<?php

namespace Hellcat\TwitchApiBundle\Model\Twitch\Auth;

/**
 * Class Factory
 * @package Hellcat\TwitchApiBundle\Model\Twitch\Auth
 */
class Factory
{
    public function token()
    {
        return new Token();
    }
}
