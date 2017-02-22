<?php

namespace Hellcat\Tools\UserBundle\Security\Authentication\Provider;

use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Hellcat\Tools\UserBundle\Security\Authentication\Token\LoginUserToken as UserToken;
use Hellcat\Tools\UserBundle\Security\User\LoginUser as User;
use Hellcat\Tools\UserBundle\Security\User\LoginUserProvider as UserProvider;

/**
 * Class Provider
 * @package Hellcat\Tools\UserBundle\Security\Authentication\Provider
 */
class LoginUserProvider implements AuthenticationProviderInterface
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
     * @param TokenInterface $token
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
        $user = null;
        $isRemeberedLogin = false;
        if ($token->getCredentialsSource() == 'LOGIN') {
            $user = $this->userProvider->loadUserByUsername($token->getUsername());
        } elseif ($token->getCredentialsSource() == 'SESSION') {
            $user = $this->userProvider->loadUserBySessionToken($token->getSessionLoginToken(), $token->getSessionVerifyHash());
            $isRemeberedLogin = true;
        }

        if (((null !== $user) && ($user->getUsername() == $token->getUsername()) && ($user->getUserEntity()->checkPassword($token->getPassword()))) || $isRemeberedLogin) {
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
