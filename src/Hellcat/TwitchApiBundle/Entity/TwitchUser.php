<?php

namespace Hellcat\TwitchApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TwitchUser
 * @package Hellcat\TwitchApiBundle\Entity
 *
 * @ORM\Table(name="twitch_user", indexes={@ORM\Index(name="idx_local_user", columns={"local_userid"})})
 * @ORM\Entity(repositoryClass="Hellcat\TwitchApiBundle\Repository\TwitchUserRepository")
 */
class TwitchUser
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=64)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="twitch_userid", type="string", length=64)
     */
    private $twitchUserId;

    /**
     * @var string
     *
     * @ORM\Column(name="local_userid", type="string", length=64)
     */
    private $localUserId;

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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return TwitchUser
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTwitchUserId()
    {
        return $this->twitchUserId;
    }

    /**
     * @param string $twitchUserId
     * @return TwitchUser
     */
    public function setTwitchUserId($twitchUserId)
    {
        $this->twitchUserId = $twitchUserId;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocalUserId()
    {
        return $this->localUserId;
    }

    /**
     * @param string $localUserId
     * @return TwitchUser
     */
    public function setLocalUserId($localUserId)
    {
        $this->localUserId = $localUserId;
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
     * @return TwitchUser
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
     * @return TwitchUser
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
     * @return TwitchUser
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
     * @return TwitchUser
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
     * @return TwitchUser
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
     * @return TwitchUser
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
     * @return TwitchUser
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;
        return $this;
    }
}
