<?php

namespace Hellcat\TwitchApiBundle\Model\Twitch\User;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class User
 * @package Hellcat\TwitchApiBundle\Model\Twitch\User
 */
final class User
{
    /**
     * @Serializer\SerializedName("display_name")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $displayName;

    /**
     * @Serializer\SerializedName("type")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $type;

    /**
     * @Serializer\SerializedName("bio")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $bio;

    /**
     * @Serializer\SerializedName("created_at")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $createdAt;

    /**
     * @Serializer\SerializedName("updated_at")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $updatedAt;

    /**
     * @Serializer\SerializedName("name")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $name;

    /**
     * @Serializer\SerializedName("_id")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $userId;

    /**
     * @Serializer\SerializedName("logo")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $logo;

    /**
     * @Serializer\SerializedName("email")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $email;

    /**
     * @Serializer\SerializedName("email_verified")
     * @Serializer\Type("boolean")
     *
     * @var boolean
     */
    private $emailVerified;

    /**
     * @Serializer\SerializedName("partnered")
     * @Serializer\Type("boolean")
     *
     * @var boolean
     */
    private $partnered;

    /**
     * @Serializer\SerializedName("twitter_connected")
     * @Serializer\Type("boolean")
     *
     * @var boolean
     */
    private $twitterConnected;

    /**
     * @Serializer\SerializedName("notifications")
     * @Serializer\Type("array<string,boolean>")
     *
     * @var boolean[]
     */
    private $notifications;

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return bool
     */
    public function isEmailVerified()
    {
        return $this->emailVerified;
    }

    /**
     * @return bool
     */
    public function isPartnered()
    {
        return $this->partnered;
    }

    /**
     * @return bool
     */
    public function isTwitterConnected()
    {
        return $this->twitterConnected;
    }

    /**
     * @return \boolean[]
     */
    public function getNotifications()
    {
        return $this->notifications;
    }
}
