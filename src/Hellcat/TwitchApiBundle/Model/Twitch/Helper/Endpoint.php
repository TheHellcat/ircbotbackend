<?php

namespace Hellcat\TwitchApiBundle\Model\Twitch\Helper;

/**
 * Class Endpoint
 * @package Hellcat\TwitchApiBundle\Model\Twitch\Helper
 */
final class Endpoint
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $url;

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return Endpoint
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Endpoint
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }
}
