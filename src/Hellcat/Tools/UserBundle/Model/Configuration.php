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
     * Configuration constructor.
     * @param integer $ttl
     * @param string $noAuthRedirUrl
     */
    public function __construct($ttl, $noAuthRedirUrl)
    {
        $this->ttl = $ttl;
        $this->noAuthRedirUrl =$noAuthRedirUrl;
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
}
