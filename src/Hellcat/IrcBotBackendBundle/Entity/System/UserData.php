<?php

namespace Hellcat\IrcBotBackendBundle\Entity\System;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserData
 *
 * @ORM\Table(name="user_data")
 * @ORM\Entity(repositoryClass="Hellcat\IrcBotBackendBundle\Repository\UserDataRepository")
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
     * @var TwitchUser
     *
     * @ORM\OneToOne(targetEntity="TwitchUser")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="local_userid")
     */
    private $twitchUser;
}
