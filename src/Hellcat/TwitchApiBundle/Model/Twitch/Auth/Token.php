<?php

namespace Hellcat\TwitchApiBundle\Model\Twitch\Auth;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class Token
 * @package Hellcat\TwitchApiBundle\Model\Twitch\Auth
 */
final class Token
{
    /**
     * @Serializer\SerializedName("access_token")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $accessToken;

    /**
     * @Serializer\SerializedName("refresh_token")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $refreshToken;

    /**
     * @Serializer\SerializedName("scope")
     * @Serializer\Type("array<string>")
     *
     * @var string[]
     */
    private $scope;

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @return string[]
     */
    public function getScope()
    {
        return $this->scope;
    }
}
