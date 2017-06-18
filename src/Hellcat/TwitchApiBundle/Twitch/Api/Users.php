<?php

namespace Hellcat\TwitchApiBundle\Twitch\Api;

use Hellcat\TwitchApiBundle\Model\Twitch\Response\User\UserResponse;

class Users extends ApiBaseClass
{
    /**
     * @param string $username Twitch user name to fetch Twitch user/channel ID for
     * @return UserResponse The ID of the user/channel
     */
    public function getUserByName($username)
    {
        $parameters = [
            'username' => $username
        ];

        $call = $this->commHelper->parseEndpoint(ApiConstants::ENDPOINT_USERS_GETUSER, $parameters);

        $responseJson = $this->commHelper->callTwitchApi($call->getUrl(), $call->getMethod());

        return $this->serializer->deserialize($responseJson, UserResponse::class, 'json');
    }
}
