<?php

namespace Hellcat\Tools\UserBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class UserRoles
 *
 * @ORM\Table(name="user_roles")
 * @ORM\Entity(repositoryClass="Hellcat\Tools\UserBundle\Repository\User\UserRoleRepository")
 *
 * @package Hellcat\Tools\UserBundle\Entity
 */
class UserRole
{
    /**
     * @var string
     *
     * @ORM\Column(name="role_id", type="string", length=64)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $roleId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=256)
     */
    private $description;

    /**
     * @var UserAcl[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="UserAcl", mappedBy="role")
     */
    private $userAcls;

    /**
     * UserRole constructor.
     */
    public function __construct()
    {
        $this->userAcls = new ArrayCollection();
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
     * @return UserRole
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return UserRole
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return UserRole
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return ArrayCollection|UserAcl[]
     */
    public function getUserAcls()
    {
        return $this->userAcls;
    }

    /**
     * @param ArrayCollection|UserAcl[] $userAcls
     * @return UserRole
     */
    public function setUserAcls($userAcls)
    {
        $this->userAcls = $userAcls;
        return $this;
    }
}
