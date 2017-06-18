<?php

namespace Hellcat\TwitchApiBundle\Model\Twitch\Response\User;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class UserResponse
 * @package Hellcat\TwitchApiBundle\Model\Twitch\Response\User
 */
class UserResponse
{
    /**
     * @Serializer\SerializedName("_total")
     * @Serializer\Type("integer")
     *
     * @var integer
     */
    private $total;

    /**
     * @Serializer\SerializedName("users")
     * @Serializer\Type("ArrayCollection<Hellcat\TwitchApiBundle\Model\Twitch\Response\User\UserType>")
     *
     * @var ArrayCollection|UserType[]
     */
    private $users;

    /**
     * UserResponse constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     * @return UserResponse
     */
    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return ArrayCollection|UserType[]
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param ArrayCollection|UserType[] $users
     * @return UserResponse
     */
    public function setUsers($users)
    {
        $this->users = $users;
        return $this;
    }
}
