<?php

namespace Hellcat\TwitchApiBundle\Twitch\Api;

use Hellcat\TwitchApiBundle\Model\Twitch\Response\Channel;

/**
 * Class Channels
 * @package Hellcat\TwitchApiBundle\Twitch\Api
 */
class Channels extends ApiBaseClass
{
    /**
     * Gets a channel object based on the OAuth token provided.
     * Get Channel returns more data than Get Channel by ID because Get Channel is privileged.
     *
     * Authentication:
     * Required scope: channel_read
     *
     * @param string $oauthToken
     * @return Channel
     */
    public function getChannel($oauthToken)
    {
        $call = $this->commHelper->parseEndpoint(ApiConstants::ENDPOINT_CHANNELS_GETCHANNEL);

        $responseJson = $this->commHelper->callTwitchApi($call->getUrl(), $call->getMethod(), $oauthToken);

        return $this->serializer->deserialize($responseJson, Channel::class, 'json');
    }

    /**
     * Gets a specified channel object.
     *
     * Authentication:
     * None
     *
     * @param string $channelId
     * @return Channel
     */
    public function getChannelById($channelId)
    {
        $parameters = [
            'channelId' => $channelId
        ];

        $call = $this->commHelper->parseEndpoint(ApiConstants::ENDPOINT_CHANNELS_GETCHANNELBYID, $parameters);

        $responseJson = $this->commHelper->callTwitchApi($call->getUrl(), $call->getMethod());

        return $this->serializer->deserialize($responseJson, Channel::class, 'json');
    }
}
