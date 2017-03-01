<?php

namespace Hellcat\Tools\UserBundle\Security\User;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\Bundle\DoctrineBundle\Registry as DoctrineRegistry;
use Hellcat\Tools\UserBundle\Entity\User\User as UserEntity;
use Hellcat\Tools\UserBundle\Entity\User\UserLoginToken as UserLoginTokenEntity;

/**
 * Class UserProvider
 * @package Hellcat\Tools\UserBundle\Security\User
 */
class LoginUserProvider implements UserProviderInterface
{
    /**
     * @var DoctrineRegistry
     */
    private $doctrineRegistry;

    /**
     * LoginUserProvider constructor.
     * @param DoctrineRegistry $doctrineRegistry
     */
    public function __construct(DoctrineRegistry $doctrineRegistry)
    {
        $this->doctrineRegistry = $doctrineRegistry;
    }

    /**
     * @param string $username
     * @return User
     */
    public function loadUserByUsername($username)
    {
        $dbUser = $this->doctrineRegistry->getManager()->getRepository(UserEntity::class);
        $userData = $dbUser->findOneBy(
            [
                'username' => $username
            ]
        );

        if (null !== $userData) {
            if( $userData->getUserType() != 'USER' ) {
                throw new UsernameNotFoundException(
                    sprintf('Invalid usertype "%s" for user "%s".', $userData->getUserType(), $username)
                );
            }
            if( $userData->isLocked() ) {
                throw new UsernameNotFoundException(
                    sprintf('User account "%s" is locked. Reason: "%s".', $username, $userData->getLockReason())
                );
            }

            $userRoles = [];
            foreach ($userData->getAcl() as $aclRole) {
                $userRoles[] = $aclRole->getRole()->getName();
            }

            return new User($username, $userData->getPassword(), '', $userRoles, $userData);
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    /**
     * @param $token
     * @param $verifyHash
     * @return User
     */
    public function loadUserBySessionToken($token, $verifyHash)
    {
        $dbLoginToken = $this->doctrineRegistry->getManager()->getRepository(UserLoginTokenEntity::class);
        $loginTokenData = $dbLoginToken->findOneBy(
            [
                'token' => $token,
                'sessionVerifyHash' => $verifyHash
            ]
        );

        if ((null !== $loginTokenData) && ($loginTokenData->getTtl() > time())) {
            return $this->loadUserByUsername($loginTokenData->getUsername());
        }

        throw new UsernameNotFoundException(
            sprintf('Invalid session token data.')
        );
    }

    /**
     * @param UserInterface $user
     * @return User|UserInterface
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass($class)
    {
        return User::class === $class;
    }
}
