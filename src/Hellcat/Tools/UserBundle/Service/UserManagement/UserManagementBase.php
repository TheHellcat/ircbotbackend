<?php

namespace Hellcat\Tools\UserBundle\Service\UserManagement;

use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\Bundle\DoctrineBundle\Registry as DoctrineRegistry;

/**
 * Class UserManagementBase
 * @package Hellcat\Tools\UserBundle\Service\UserManagement
 */
abstract class UserManagementBase
{
    /**
     * @var DoctrineRegistry
     */
    private $doctrine;

    /**
     * @var Session
     */
    private $session;

    /**
     * UserManagementBase constructor.
     * @param DoctrineRegistry $doctrine
     * @param Session $session
     */
    public function __construct(DoctrineRegistry $doctrine, Session $session)
    {
        $this->doctrine = $doctrine;
        $this->session = $session;

        if (!$this->session->isStarted()) {
            $this->session->start();
        }
    }
}
