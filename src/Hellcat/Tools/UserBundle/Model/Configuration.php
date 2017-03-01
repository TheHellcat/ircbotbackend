<?php

namespace Hellcat\Tools\UserBundle\Model;

/**
 * Class Configuration
 * @package Hellcat\Tools\UserBundle\Model
 */
class Configuration
{
    /**
     * @var integer
     */
    private $ttl;

    /**
     * @var string
     */
    private $noAuthRedirUrl;

    /**
     * @var integer
     */
    private $rememberCookieTtl;

    /**
     * Configuration constructor.
     * @param integer $ttl
     * @param string $noAuthRedirUrl
     * @param integer $rememberCookieTtl
     */
    public function __construct($ttl, $noAuthRedirUrl, $rememberCookieTtl)
    {
        $this->ttl = $ttl;
        $this->noAuthRedirUrl = $noAuthRedirUrl;
        $this->rememberCookieTtl = $rememberCookieTtl;
    }

    /**
     * @return int
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * @return string
     */
    public function getNoAuthRedirUrl()
    {
        return $this->noAuthRedirUrl;
    }

    /**
     * @return integer
     */
    public function getRememberCookieTtl()
    {
        return $this->rememberCookieTtl;
    }
}
