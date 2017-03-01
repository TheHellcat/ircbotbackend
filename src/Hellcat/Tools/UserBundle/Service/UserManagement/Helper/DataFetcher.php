<?php

namespace Hellcat\Tools\UserBundle\Service\UserManagement\Helper;

use Hellcat\Tools\UserBundle\Service\UserManagement\UserManagementBase;
use Hellcat\Tools\UserBundle\Entity\User\UserRole as UserRoleEntity;
use Hellcat\Tools\UserBundle\Entity\User\User as UserEntity;

/**
 * Class DataFetcher
 * @package Hellcat\Tools\UserBundle\Service\UserManagement\Helper
 */
class DataFetcher extends UserManagementBase
{
    /**
     * @param string $identifier
     * @param string $entityClass
     * @param string $fieldId
     * @param string $fieldName
     * @return null|object
     */
    private function fetch($identifier, $entityClass, $fieldId, $fieldName)
    {
        $dbItem = $this->doctrine->getManager()->getRepository($entityClass);

        // try fetching by ID
        $item = $dbItem->findOneBy(
            [
                $fieldId => $identifier
            ]
        );

        if (null === $item) {
            // if that didn't yield any result, try by name
            $item = $dbItem->findOneBy(
                [
                    $fieldName => $identifier
                ]
            );
        }

        return $item;
    }

    /**
     * @param string $identifier
     * @return UserEntity|null|object
     */
    public function fetchUser($identifier)
    {
        return $this->fetch($identifier, UserEntity::class, 'userId', 'username');
    }

    /**
     * @param string $identifier
     * @return UserRoleEntity|null|object
     */
    public function fetchRole($identifier)
    {
        return $this->fetch($identifier, UserRoleEntity::class, 'roleId', 'name');
    }
}
