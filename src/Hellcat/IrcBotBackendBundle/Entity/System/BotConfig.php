<?php

namespace Hellcat\IrcBotBackendBundle\Entity\System;

use Doctrine\ORM\Mapping as ORM;

/**
 * SystemConfig
 *
 * @ORM\Table(name="bot_config")
 * @ORM\Entity(repositoryClass="Hellcat\IrcBotBackendBundle\Repository\BotConfigRepository")
 */
class BotConfig
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
     * @ORM\Column(name="bot_id", type="string", length=32)
     */
    private $botId;

    /**
     * @var string
     *
     * @ORM\Column(name="key", type="string", length=64)
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
     * @return BotConfig
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getBotId()
    {
        return $this->botId;
    }

    /**
     * @param string $botId
     * @return BotConfig
     */
    public function setBotId($botId)
    {
        $this->botId = $botId;
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
     * @return BotConfig
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
     * @return BotConfig
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}
