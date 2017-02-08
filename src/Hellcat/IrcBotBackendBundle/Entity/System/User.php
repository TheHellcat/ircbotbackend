<?php

namespace Hellcat\IrcBotBackendBundle\Entity\System;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Hellcat\IrcBotBackendBundle\Repository\UserRepository")
 */
class User
{
    /**
     * @var string
     *
     * @ORM\Column(name="user_id", type="string", length=64)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="twitch_id", type="string", length=64)
     */
    private $twitchId;

    /**
     * @var string
     *
     * @ORM\Column(name="display_name", type="string", length=128)
     */
    private $displayName;

    /**
     * @var string
     *
     * @ORM\Column(name="channel", type="string", length=128)
     */
    private $channel;

    /**
     * @var string
     *
     * @ORM\Column(name="oauth_token", type="string", length=64)
     */
    private $oauthToken;

    /**
     * @var string
     *
     * @ORM\Column(name="oauth_refresh_token", type="string", length=256)
     */
    private $oauthRefreshToken;

    /**
     * @var string
     *
     * @ORM\Column(name="scope", type="string", length=256)
     */
    private $scope;

    /**
     * @var string
     *
     * @ORM\Column(name="created", type="bigint")
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="last_login", type="bigint")
     */
    private $lastLogin;

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     * @return User
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getTwitchId()
    {
        return $this->twitchId;
    }

    /**
     * @param string $twitchId
     * @return User
     */
    public function setTwitchId($twitchId)
    {
        $this->twitchId = $twitchId;
        return $this;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param string $displayName
     * @return User
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @param string $channel
     * @return User
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * @return string
     */
    public function getOauthToken()
    {
        return $this->oauthToken;
    }

    /**
     * @param string $oauthToken
     * @return User
     */
    public function setOauthToken($oauthToken)
    {
        $this->oauthToken = $oauthToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getOauthRefreshToken()
    {
        return $this->oauthRefreshToken;
    }

    /**
     * @param string $oauthRefreshToken
     * @return User
     */
    public function setOauthRefreshToken($oauthRefreshToken)
    {
        $this->oauthRefreshToken = $oauthRefreshToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param string $scope
     * @return User
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param string $created
     * @return User
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * @param string $lastLogin
     * @return User
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;
        return $this;
    }
}

