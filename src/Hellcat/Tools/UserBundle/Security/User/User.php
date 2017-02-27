<?php

namespace Hellcat\Tools\UserBundle\Security\User;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Hellcat\Tools\UserBundle\Entity\User\User as UserEntity;

/**
 * Class User
 * @package Hellcat\Tools\UserBundle\Security\User
 */
class User implements UserInterface, EquatableInterface
{
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
    private $salt;

    /**
     * @var array
     */
    private $roles;

    /**
     * @var UserEntity
     */
    private $userEntity;

    /**
     * User constructor.
     * @param string $username
     * @param string $password
     * @param string $salt
     * @param array $roles
     * @param string $userEntity
     */
    public function __construct($username, $password, $salt, array $roles, $userEntity)
    {
        $this->username = $username;
        $this->password = $password;
        $this->salt = $salt;
        $this->roles = $roles;
        $this->userEntity = $userEntity;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return UserEntity
     */
    public function getUserEntity()
    {
        return $this->userEntity;
    }

    /**
     * @param $entity
     * @return $this
     */
    public function setUserEntity($entity)
    {
        $this->userEntity = $entity;
        return $this;
    }

    /**
     * void
     */
    public function eraseCredentials()
    {
        // satisfy the interface
    }

    /**
     * @param UserInterface $user
     * @return bool
     */
    public function isEqualTo(UserInterface $user)
    {
        if (
            (!$user instanceof User)
            && ($this->password !== $user->getPassword())
            && ($this->salt !== $user->getSalt())
            && ($this->username !== $user->getUsername())
        ) {
            $isEqual = false;
        } else {
            $isEqual = true;
        }

        return $isEqual;
    }
}
