<?php

namespace Hellcat\TwitchApiBundle\Twitch\Api;

use GuzzleHttp\Client as HttpClient;
use JMS\Serializer\Serializer;
use Hellcat\TwitchApiBundle\Model\Configuration;
use Hellcat\TwitchApiBundle\Twitch\Helper;
use Hellcat\TwitchApiBundle\Model\Factory as ModelFactory;

/**
 * Class ApiBaseClass
 * @package Hellcat\TwitchApiBundle\Twitch\Api
 */
class ApiBaseClass
{
    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @var Helper\CommunicationHelper
     */
    protected $commHelper;

    /**
     * @var ModelFactory
     */
    protected $modelFactory;

    /**
     * Auth constructor.
     * @param Configuration $config
     * @param HttpClient $httpClient
     * @param Serializer $serializer
     */
    public function __construct(
        Configuration $config,
        HttpClient $httpClient,
        Serializer $serializer,
        Helper\CommunicationHelper $commHelper,
        ModelFactory $modelFactory
    )
    {
        $this->config = $config;
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
        $this->commHelper = $commHelper;
        $this->modelFactory = $modelFactory;
    }
}
