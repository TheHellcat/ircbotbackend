<?php

namespace Hellcat\TwitchApiBundle\Model;

/**
 * Class Configuration
 *
 * Bundle configuration
 *
 * @package Hellcat\TwitchApiBundle\Model
 */
final class Configuration
{
    /**
     * @var string
     */
    private $apiEndpoint;

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * Configuration constructor.
     * @param array $config
     */
    public function __construct($config)
    {
        $this->apiEndpoint = isset($config['api_endpoint_root']) ? trim($config['api_endpoint_root'], '/') : '';
        $this->clientId = isset($config['client_id']) ? $config['client_id'] : '';
        $this->clientSecret = isset($config['client_secret']) ? $config['client_secret'] : '';
    }

    /**
     * @return string
     */
    public function getApiEndpoint()
    {
        return $this->apiEndpoint;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }
}
