<?php

namespace Hellcat\IrcBotBackendBundle\Entity;

use Doctrine\Bundle\DoctrineBundle\Registry as DoctrineRegistry;
use Doctrine\Common\Persistence\ObjectManager as DoctrineObjectManager;

/**
 * Class Manager
 * @package Hellcat\IrcBotBackendBundle\Entity
 */
class Manager
{
    /**
     * @var array
     */
    private $factory;

    /**
     * @var DoctrineRegistry
     */
    private $doctrineRegistry;

    public function __construct(DoctrineRegistry $doctrineRegistry)
    {
        $this->doctrineRegistry = $doctrineRegistry;
    }

    /**
     * @return System\Factory
     */
    public function system()
    {
        if (!isset($this->factory[__FUNCTION__])) {
            $this->factory[__FUNCTION__] = new System\Factory();
        }
        return $this->factory[__FUNCTION__];
    }

    /**
     * @return DoctrineObjectManager
     */
    public function getDoctrineEntityManager()
    {
        return $this->doctrineRegistry->getManager();
    }
}
