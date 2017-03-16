<?php

namespace Hellcat\ChatBotBackendBundle\Entity\System;

use Doctrine\ORM\Mapping as ORM;
use Hellcat\TwitchApiBundle\Entity\TwitchUser;

/**
 * UserData
 *
 * @ORM\Table(name="user_data")
 * @ORM\Entity(repositoryClass="Hellcat\ChatBotBackendBundle\Repository\UserDataRepository")
 */
class UserData
{
    /**
     * @var string
     *
     * @ORM\Column(name="data_id", type="string", length=64)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $dataId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_id", type="string", length=64)
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=128)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="twitch_entity_id", type="string", length=64, nullable=true)
     */
    private $twitchEntityId;

    /**
     * @var TwitchUser
     *
     * @ORM\OneToOne(targetEntity="Hellcat\TwitchApiBundle\Entity\TwitchUser")
     * @ORM\JoinColumn(name="twitch_entity_id", referencedColumnName="id")
     */
    private $twitchUser;

    /**
     * @return string
     */
    public function getDataId()
    {
        return $this->dataId;
    }

    /**
     * @param string $dataId
     * @return UserData
     */
    public function setDataId($dataId)
    {
        $this->dataId = $dataId;
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
     * @return UserData
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return UserData
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return TwitchUser
     */
    public function getTwitchUser()
    {
        return $this->twitchUser;
    }

    /**
     * @return string
     */
    public function getTwitchEntityId()
    {
        return $this->twitchEntityId;
    }

    /**
     * @param string $twitchEntityId
     * @return UserData
     */
    public function setTwitchEntityId($twitchEntityId)
    {
        $this->twitchEntityId = $twitchEntityId;
        return $this;
    }
}
