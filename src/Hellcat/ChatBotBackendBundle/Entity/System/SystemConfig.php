<?php

namespace Hellcat\ChatBotBackendBundle\Entity\System;

use Doctrine\ORM\Mapping as ORM;

/**
 * SystemConfig
 *
 * @ORM\Table(name="system_config")
 * @ORM\Entity(repositoryClass="Hellcat\ChatBotBackendBundle\Repository\SystemConfigRepository")
 */
class SystemConfig
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=64)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="key", type="string", length=32)
     */
    private $key;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=256)
     */
    private $value;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return SystemConfig
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return SystemConfig
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return SystemConfig
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}

