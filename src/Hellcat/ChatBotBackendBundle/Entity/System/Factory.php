<?php

namespace Hellcat\ChatBotBackendBundle\Entity\System;

/**
 * Class Factory
 * @package Hellcat\ChatBotBackendBundle\Entity\System
 */
class Factory
{
    /**
     * @return TwitchUser
     */
    public function twitchUser()
    {
        return new TwitchUser();
    }

    /**
     * @return User
     */
    public function user()
    {
        return new User();
    }

    /**
     * @return BotConfig
     */
    public function botConfig()
    {
        return new BotConfig();
    }

    /**
     * @return SystemConfig
     */
    public function systemConfig()
    {
        return new SystemConfig();
    }
}
