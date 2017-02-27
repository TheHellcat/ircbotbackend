<?php

namespace Hellcat\Tools\UserBundle\Security\Authentication\Provider;

use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Hellcat\Tools\UserBundle\Security\Authentication\Token\ApiUserToken as UserToken;
use Hellcat\Tools\UserBundle\Security\User\User as User;
use Hellcat\Tools\UserBundle\Security\User\ApiUserProvider as UserProvider;

/**
 * Class ApiUserProvider
 * @package Hellcat\Tools\UserBundle\Security\Authentication\Provider
 */
class ApiUserProvider implements AuthenticationProviderInterface
{
    /**
     * @var UserProvider
     */
    private $userProvider;

    /**
     * @var CacheItemPoolInterface
     */
    private $cachePool;

    /**
     * Provider constructor.
     * @param UserProvider $userProvider
     * @param CacheItemPoolInterface $cachePool
     */
    public function __construct(UserProvider $userProvider, CacheItemPoolInterface $cachePool)
    {
        $this->userProvider = $userProvider;
        $this->cachePool = $cachePool;
    }

    /**
     * @param UserProvider $userProvider
     */
    public function setUserProvider(UserProvider $userProvider)
    {
        $this->userProvider = $userProvider;
    }

    /**
     * @param UserToken $token
     * @return UserToken
     */
    public function authenticate(TokenInterface $token)
    {
        if (!($token instanceof UserToken)) {
            throw new AuthenticationException('Unsupported user token. Expected: ' . UserToken::class . ', got: ' . get_class($token));
        }
        if (!($this->userProvider instanceof UserProvider)) {
            throw new AuthenticationException('Unsupported user provider configuration. Expected: ' . UserProvider::class . ', got: ' . get_class($this->userProvider));
        }

        /** @var User $user */
        $user = $this->userProvider->loadUserByUsername($token->getUsername());

        $hasToken = false;
        foreach( $user->getUserEntity()->getApiTokenAssigns() as $tokenAssign ) {
            $hasToken = $hasToken || ( $tokenAssign->getToken()->getTokenIdentifier() == $token->getApiToken() );
        }

        if ( ( $token->getAuthHashInRequest() == $token->getAuthHashGenerated() ) && $hasToken ) {
            $authenticatedToken = new UserToken($user->getRoles());
            $authenticatedToken->setUser($user);
            $authenticatedToken->setUsername($user->getUsername());

            return $authenticatedToken;
        }

        throw new AuthenticationException('Authentication failed.');
    }

    /**
     * @param TokenInterface $token
     * @return bool
     */
    public function supports(TokenInterface $token)
    {
        return $token instanceof UserToken;
    }
}
