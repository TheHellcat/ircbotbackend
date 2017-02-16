<?php

namespace Hellcat\Tools\UserBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class UserLoginToken
 *
 * @ORM\Table(name="user_logintoken")
 * @ORM\Entity(repositoryClass="Hellcat\Tools\UserBundle\Repository\User\UserLoginTokenRepository")
 *
 * @package Hellcat\Tools\UserBundle\Entity\User
 */
class UserLoginToken
{
    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=64)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $token;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=64)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="session_verify_hash", type="string", length=64)
     */
    private $sessionVerifyHash;

    /**
     * @var string
     *
     * @ORM\Column(name="ttl", type="bigint")
     */
    private $ttl;

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return UserLoginToken
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return UserLoginToken
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * @param string $ttl
     * @return UserLoginToken
     */
    public function setTtl($ttl)
    {
        $this->ttl = $ttl;
        return $this;
    }

    /**
     * @return string
     */
    public function getSessionVerifyHash()
    {
        return $this->sessionVerifyHash;
    }

    /**
     * @param string $sessionVerifyHash
     * @return UserLoginToken
     */
    public function setSessionVerifyHash($sessionVerifyHash)
    {
        $this->sessionVerifyHash = $sessionVerifyHash;
        return $this;
    }
}
