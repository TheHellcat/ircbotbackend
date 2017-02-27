<?php

namespace Hellcat\Tools\UserBundle\Service\UserManagement;

use Doctrine\Bundle\DoctrineBundle\Registry as DoctrineRegistry;
use Hellcat\Tools\UserBundle\Entity\Factory as EntityFactory;
use Hellcat\Tools\UserBundle\Entity\User\UserRole as UserRoleEntity;
use Hellcat\Tools\UserBundle\Model\Factory as ModelFactory;
use Hellcat\Tools\UserBundle\Model\User\CommonResult;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class Role
 * @package Hellcat\Tools\UserBundle\Service\UserManagement
 */
class Role extends UserManagementBase
{
    /**
     * @var User
     */
    private $userService;

    /**
     * Role constructor.
     * @param DoctrineRegistry $doctrine
     * @param Session $session
     * @param ModelFactory $modelFactory
     * @param EntityFactory $entityFactory
     * @param User $userService
     */
    public function __construct(
        DoctrineRegistry $doctrine,
        Session $session,
        ModelFactory $modelFactory,
        EntityFactory $entityFactory,
        User $userService
    )
    {
        parent::__construct($doctrine, $session, $modelFactory, $entityFactory);

        $this->userService = $userService;
    }

    /**
     * @param string $identifier
     * @return UserRoleEntity|null
     */
    public function fetchRoleRaw($identifier)  // TODO: refactor this into a public:false service
    {
        $dbRole = $this->doctrine->getManager()->getRepository(UserRoleEntity::class);

        // try fetching the role by the name
        $role = $dbRole->findOneBy(
            [
                'name' => $identifier
            ]
        );

        if (null === $role) {
            // if that didn't yield any result, try role ID
            $role = $dbRole->findOneBy(
                [
                    'roleId' => $identifier
                ]
            );
        }

        return $role;
    }

    /**
     * @param $roleName
     * @param $description
     * @return CommonResult
     */
    public function addRole($roleName, $description)
    {
        $result = $this->modelFactory->user()->commonResult();

        $role = $this->fetchRoleRaw($roleName);

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
        $user = $this->userService->fetchUserRaw($user);
        $role = $this->fetchRoleRaw($role);
        $assign = $this->entityFactory->user()->userAcl();

        $assign
            ->setRole($role)
            ->setUser($user);

        $em = $this->doctrine->getManager();
        $em->persist($assign);
        $em->flush();
    }
}
