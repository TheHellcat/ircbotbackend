<?php

namespace Hellcat\Tools\UserBundle\Security\User;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\Bundle\DoctrineBundle\Registry as DoctrineRegistry;
use Hellcat\Tools\UserBundle\Entity\User\User as UserEntity;

/**
 * Class ApiUserProvider
 * @package Hellcat\Tools\UserBundle\Security\User
 */
class ApiUserProvider implements UserProviderInterface
{
    /**
     * @var DoctrineRegistry
     */
    private $doctrineRegistry;

    /**
     * ApiUserProvider constructor.
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
            if( $userData->getUserType() != 'API' ) {
                throw new UsernameNotFoundException(
                    sprintf('Invalid usertype "%s" for user "%s".', $userData->getUserType(), $username)
                );
            }
            if( $userData->isLocked() ) {
                throw new UsernameNotFoundException(
                    sprintf('User account "%s" is locked. Reason: "%s".', $username, $userData->getLockReason())
                );
            }

            return new User($username, $userData->getPassword(), '', [], $userData);
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    /**
     * @param UserInterface $user
     * @return User
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
