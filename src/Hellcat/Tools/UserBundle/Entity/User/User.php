<?php

namespace Hellcat\Tools\UserBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Hellcat\Tools\UserBundle\Repository\User\UserRepository")
 *
 * @package Hellcat\Tools\UserBundle\Entity
 */
class User
{
    /**
     * @var string
     *
     * @ORM\Column(name="user_id", type="string", length=64)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=64)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=128)
     */
    private $password;

    /**
     * @var boolean
     *
     * @ORM\Column(name="locked", type="boolean")
     */
    private $locked;

    /**
     * @var string
     *
     * @ORM\Column(name="lock_reason", type="string", length=256)
     */
    private $lockReason;

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
     * @var UserAcl[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="UserAcl", mappedBy="user")
     */
    private $acl;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->acl = new ArrayCollection();
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 11]);
        return $this;
    }

    /**
     * @param $password
     * @return bool
     */
    public function checkPassword($password)
    {
        return password_verify($password, $this->password);
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
     * @return User
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
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
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return bool
     */
    public function isLocked()
    {
        return $this->locked;
    }

    /**
     * @param bool $locked
     * @return User
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;
        return $this;
    }

    /**
     * @return string
     */
    public function getLockReason()
    {
        return $this->lockReason;
    }

    /**
     * @param string $lockReason
     * @return User
     */
    public function setLockReason($lockReason)
    {
        $this->lockReason = $lockReason;
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
     * @return User
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
     * @return User
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;
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
     * @return UserAcl[]|ArrayCollection
     */
    public function getAcl()
    {
        return $this->acl;
    }

    /**
     * @param UserAcl[]|ArrayCollection $acl
     * @return User
     */
    public function setAcl($acl)
    {
        $this->acl = $acl;
        return $this;
    }
}
