<?php

namespace Hellcat\Tools\UserBundle\Model;

/**
 * Class Factory
 * @package Hellcat\Tools\UserBundle\Model
 */
class Factory
{
    /**
     * @var array
     */
    private $factory;

    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * Manager constructor.
     */
    public function __construct(Configuration $config)
    {
        $this->factory = [];
        $this->configuration = $config;
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

    /**
     * @return Configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }
}
