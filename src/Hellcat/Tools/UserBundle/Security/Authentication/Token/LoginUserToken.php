<?php

namespace Hellcat\Tools\UserBundle\Security\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

/**
 * Class UserToken
 * @package Hellcat\Tools\UserBundle\Security\Authentication\Token
 */
class LoginUserToken extends AbstractToken
{
    /**
     * @var integer
     */
    private $created;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $sessionLoginToken;

    /**
     * @var string
     */
    private $sessionVerifyHash;

    /**
     * @var string
     */
    private $credentialsSource;

    /**
     * UserToken constructor.
     * @param array $roles
     */
    public function __construct(array $roles = array())
    {
        parent::__construct($roles);

        $this->created = time();

        // If the user has roles, consider it authenticated
        $this->setAuthenticated(count($roles) > 0);
    }

    /**
     * @return string
     */
    public function getCredentials()
    {
        return '';
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
     * @return LoginUserToken
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return LoginUserToken
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return int
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return string
     */
    public function getCredentialsSource()
    {
        return $this->credentialsSource;
    }

    /**
     * @param string $credentialsSource
     * @return LoginUserToken
     */
    public function setCredentialsSource($credentialsSource)
    {
        $this->credentialsSource = strtoupper($credentialsSource);
        return $this;
    }

    /**
     * @return string
     */
    public function getSessionLoginToken()
    {
        return $this->sessionLoginToken;
    }

    /**
     * @param string $sessionLoginToken
     * @return LoginUserToken
     */
    public function setSessionLoginToken($sessionLoginToken)
    {
        $this->sessionLoginToken = $sessionLoginToken;
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
     * @return LoginUserToken
     */
    public function setSessionVerifyHash($sessionVerifyHash)
    {
        $this->sessionVerifyHash = $sessionVerifyHash;
        return $this;
    }
}
