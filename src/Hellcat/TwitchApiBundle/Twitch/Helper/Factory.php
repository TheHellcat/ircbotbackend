<?php

namespace Hellcat\TwitchApiBundle\Twitch\Helper;

use Hellcat\TwitchApiBundle\Twitch\Twitch;

/**
 * Class Factory
 * @package Hellcat\TwitchApiBundle\Twitch\Helper
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
     * @return CommunicationHelper
     */
    public function communication()
    {
        if (!isset($this->factory[__FUNCTION__])) {
            $this->factory[__FUNCTION__] = new CommunicationHelper($this->twMan);
        }
        return $this->factory[__FUNCTION__];
    }
}
