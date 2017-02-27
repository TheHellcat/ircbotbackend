<?php

namespace Hellcat\Tools\UserBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class UserAcl
 *
 * @ORM\Table(name="user_api_tokenassign")
 * @ORM\Entity(repositoryClass="Hellcat\Tools\UserBundle\Repository\User\UserApiTokenAssignRepository")
 *
 * @package Hellcat\Tools\UserBundle\Entity
 */
class UserApiTokenAssign
{
    /**
     * @var string
     *
     * @ORM\Column(name="asgn_id", type="string", length=64)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $asgnId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_id", type="string", length=64)
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="token_id", type="string", length=64)
     */
    private $tokenId;

    /**
     * @var string
     *
     * @ORM\Column(name="secret", type="string", length=128)
     */
    private $secret;

    /**
     * @var UserApiToken
     *
     * @ORM\ManyToOne(targetEntity="UserApiToken", inversedBy="userTokenAssigns")
     * @ORM\JoinColumn(name="token_id", referencedColumnName="token_id")
     */
    private $token;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="apiTokenAssigns")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    private $user;

    /**
     * @return string
     */
    public function getAsgnId()
    {
        return $this->asgnId;
    }

    /**
     * @param string $asgnId
     * @return UserApiTokenAssign
     */
    public function setAsgnId($asgnId)
    {
        $this->asgnId = $asgnId;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     * @return UserApiTokenAssign
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getTokenId()
    {
        return $this->tokenId;
    }

    /**
     * @param string $tokenId
     * @return UserApiTokenAssign
     */
    public function setTokenId($tokenId)
    {
        $this->tokenId = $tokenId;
        return $this;
    }

    /**
     * @return UserApiToken
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param UserApiToken $token
     * @return UserApiTokenAssign
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return UserApiTokenAssign
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     * @return UserApiTokenAssign
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
        return $this;
    }
}
