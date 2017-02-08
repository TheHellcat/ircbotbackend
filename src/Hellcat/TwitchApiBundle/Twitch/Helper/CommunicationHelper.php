<?php

namespace Hellcat\TwitchApiBundle\Twitch\Helper;

use Hellcat\TwitchApiBundle\Twitch\Twitch;

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
    public function callTwitchApi($apiCall, $method, $oauthToken, $data = '')
    {
        $url = $this->twMan->getConfig()->getApiEndpoint() . $apiCall;

        $httpOptions = [
            'body' => $data,
            'headers' => [
                'Client-ID' => $this->twMan->getConfig()->getClientId(),
                'Authorization' => 'OAuth ' . $oauthToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/vnd.twitchtv.v5+json'
            ]
        ];

        $httpResponse = null;
        if ('GET' == strtoupper($method)) {
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
        }

        $responseBody = '';
        if( null !== $httpResponse ) {
            $responseBody = $httpResponse->getBody()->getContents();
        }
        return $responseBody;
    }
}
