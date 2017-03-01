<?php

namespace Hellcat\Tools\UserBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class UserAcl
 *
 * @ORM\Table(name="user_acl")
 * @ORM\Entity(repositoryClass="Hellcat\Tools\UserBundle\Repository\User\UserAclRepository")
 *
 * @package Hellcat\Tools\UserBundle\Entity
 */
class UserAcl
{
    /**
     * @var string
     *
     * @ORM\Column(name="acl_id", type="string", length=64)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $aclId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_id", type="string", length=64)
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="role_id", type="string", length=64)
     */
    private $roleId;

    /**
     * @var UserRole
     *
     * @ORM\ManyToOne(targetEntity="UserRole", inversedBy="userAcls")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="role_id")
     */
    private $role;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="acl")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    private $user;

    /**
     * @return string
     */
    public function getAclId()
    {
        return $this->aclId;
    }

    /**
     * @param string $aclId
     * @return UserAcl
     */
    public function setAclId($aclId)
    {
        $this->aclId = $aclId;
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
     * @return UserAcl
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * @param string $roleId
     * @return UserAcl
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;
        return $this;
    }

    /**
     * @return UserRole
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param UserRole $role
     * @return UserAcl
     */
    public function setRole($role)
    {
        $this->role = $role;
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
     * @return UserAcl
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
}
