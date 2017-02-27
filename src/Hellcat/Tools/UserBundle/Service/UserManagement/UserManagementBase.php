<?php

namespace Hellcat\Tools\UserBundle\Service\UserManagement;

use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\Bundle\DoctrineBundle\Registry as DoctrineRegistry;
use Hellcat\Tools\UserBundle\Model\Factory as ModelFactory;
use Hellcat\Tools\UserBundle\Entity\Factory as EntityFactory;

/**
 * Class UserManagementBase
 * @package Hellcat\Tools\UserBundle\Service\UserManagement
 */
abstract class UserManagementBase
{
    /**
     * @var DoctrineRegistry
     */
    protected $doctrine;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var ModelFactory
     */
    protected $modelFactory;

    /**
     * @var EntityFactory
     */
    protected $entityFactory;

    /**
     * UserManagementBase constructor.
     * @param DoctrineRegistry $doctrine
     * @param Session $session
     */
    public function __construct(
        DoctrineRegistry $doctrine,
        Session $session,
        ModelFactory $modelFactory,
        EntityFactory $entityFactory
    )
    {
        $this->doctrine = $doctrine;
        $this->session = $session;
        $this->modelFactory = $modelFactory;
        $this->entityFactory = $entityFactory;

        if (!$this->session->isStarted()) {
            $this->session->start();
        }
    }
}
