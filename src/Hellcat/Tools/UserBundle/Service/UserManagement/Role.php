<?php

namespace Hellcat\Tools\UserBundle\Service\UserManagement;

use Hellcat\Tools\UserBundle\Model\User\CommonResult;

/**
 * Class Role
 * @package Hellcat\Tools\UserBundle\Service\UserManagement
 */
class Role extends UserManagementBase
{
    /**
     * @param $roleName
     * @param $description
     * @return CommonResult
     */
    public function addRole($roleName, $description)
    {
        $result = $this->modelFactory->user()->commonResult();

        $role = $this->dataFetcher->fetchRole($roleName);

        if (null === $role) {
            $role = $this->entityFactory->user()->userRole();

            $role
                ->setName($roleName)
                ->setDescription($description);

            $em = $this->doctrine->getManager();
            $em->persist($role);
            $em->flush();

            $result
                ->setSuccess(true)
                ->setMessage($role->getRoleId());
        } else {
            $result
                ->setSuccess(false)
                ->setMessage('Role already exists');
        }

        return $result;
    }

    public function assignRole($user, $role)
    {
        $user = $this->dataFetcher->fetchUser($user);
        $role = $this->dataFetcher->fetchRole($role);
        $assign = $this->entityFactory->user()->userAcl();

        $assign
            ->setRole($role)
            ->setUser($user);

        $em = $this->doctrine->getManager();
        $em->persist($assign);
        $em->flush();
    }
}
