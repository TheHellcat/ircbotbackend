<?php

namespace Hellcat\TwitchApiBundle\Twitch\Helper;

use Hellcat\TwitchApiBundle\Twitch\Twitch;
use \Hellcat\TwitchApiBundle\Model\Twitch\Helper\Endpoint;

/**
 * Class CommunicationHelper
 * @package Hellcat\TwitchApiBundle\Twitch\Helper
 */
class CommunicationHelper
{
    /**
     * @var Twitch
     */
    private $twMan;

    /**
     * CommunicationHelper constructor.
     * @param Twitch $twMan
     */
    public function __construct(Twitch $twMan)
    {
        $this->twMan = $twMan;
    }

    /**
     * Make call to Twitch kraken API endpoint.
     * Returns the body of the response.
     *
     * @param string $apiCall URL below /kraken to call
     * @param string $method HTTP method (GET, POST, PUT, etc.)
     * @param string $oauthToken OAuth token of the current user for privileged calls
     * @param string $data [optional] body data (usually JSON) for the call
     * @return string
     */
    public function callTwitchApi($apiCall, $method, $oauthToken = '', $data = '')
    {
        $url = $this->twMan->getConfig()->getApiEndpoint() . $apiCall;

        $httpHeaders = [
            'Client-ID' => $this->twMan->getConfig()->getClientId(),
//            'Content-Type' => 'application/json',
            'Accept' => 'application/vnd.twitchtv.v5+json'
        ];

        if( strlen($oauthToken)>1 ){
            $httpHeaders['Authorization'] = 'OAuth ' . $oauthToken;
        }

        $httpOptions = [
//            'body' => $data,
            'headers' => $httpHeaders
        ];

        $httpResponse = null;
        if ('GET' == strtoupper($method)) {
dump($url);
dump($httpOptions); //$httpOptions = [];
            $httpResponse = $this->twMan->getHttpClient()->get(
                $url,
                $httpOptions
            );
        } elseif ('POST' == strtoupper($method)) {
            $httpResponse = $this->twMan->getHttpClient()->post(
                $url,
                $httpOptions
            );
        } elseif ('PUT' == strtoupper($method)) {
            $httpResponse = $this->twMan->getHttpClient()->put(
                $url,
                $httpOptions
            );
        } elseif ('DELETE' == strtoupper($method)) {
            $httpResponse = $this->twMan->getHttpClient()->delete(
                $url,
                $httpOptions
            );
        }

        $responseBody = '';
        if (null !== $httpResponse) {
            $responseBody = $httpResponse->getBody()->getContents();
        }
        return $responseBody;
    }

    /**
     * @param string $endpoint
     * @param array $parameters
     * @return Endpoint
     */
    public function parseEndpoint($endpoint, $parameters = [])
    {
        foreach ($parameters as $paramName => $paramValue) {
            $endpoint = str_replace('{' . $paramName . '}', $paramValue, $endpoint);
        }

        $endpoint = explode(':', $endpoint);
        $endpointData = $this->twMan->getModelFactory()->twitch()->helper()->endpoint();
        $endpointData
            ->setMethod($endpoint[0])
            ->setUrl($endpoint[1]);

        return $endpointData;
    }
}
