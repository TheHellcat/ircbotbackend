<?php

namespace Hellcat\Tools\UserBundle\Security\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

/**
 * Class ApiUserToken
 * @package Hellcat\Tools\UserBundle\Security\Authentication\Token
 */
class ApiUserToken extends AbstractToken
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
    private $authHashInRequest;

    /**
     * @var array
     */
    private $authHashGenerated;

    /**
     * @var string
     */
    private $apiToken;

    /**
     * UserToken constructor.
     * @param array $roles
     */
    public function __construct(array $roles = array())
    {
        parent::__construct($roles);

        $this->created = time();
        $this->authHashGenerated = [];

        // If the user has roles, consider it authenticated
        $this->setAuthenticated(true);  // TODO: try if this can jsut be thrown out
    }

    /**
     * @return string
     */
    public function getCredentials()
    {
        return '';
    }

    /**
     * @return int
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param int $created
     * @return ApiUserToken
     */
    public function setCreated($created)
    {
        $this->created = $created;
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
     * @return ApiUserToken
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthHashInRequest()
    {
        return $this->authHashInRequest;
    }

    /**
     * @param string $authHashInRequest
     * @return ApiUserToken
     */
    public function setAuthHashInRequest($authHashInRequest)
    {
        $this->authHashInRequest = $authHashInRequest;
        return $this;
    }

    /**
     * @return array
     */
    public function getAuthHashGenerated()
    {
        return $this->authHashGenerated;
    }

    /**
     * @param array $authHashGenerated
     * @return ApiUserToken
     */
    public function setAuthHashGenerated($authHashGenerated)
    {
        $this->authHashGenerated = $authHashGenerated;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    /**
     * @param string $apiToken
     * @return ApiUserToken
     */
    public function setApiToken($apiToken)
    {
        $this->apiToken = $apiToken;
        return $this;
    }
}
