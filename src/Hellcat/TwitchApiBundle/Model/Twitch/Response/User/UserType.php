<?php

namespace Hellcat\TwitchApiBundle\Model\Twitch\Response\User;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class UserType
 * @package Hellcat\TwitchApiBundle\Model\Twitch\Response\User
 */
class UserType
{
    /**
     * @Serializer\SerializedName("display_name")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $displayName;

    /**
     * @Serializer\SerializedName("_id")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $id;

    /**
     * @Serializer\SerializedName("name")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $name;

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
     * @Serializer\SerializedName("logo")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $logo;

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param string $displayName
     * @return UserType
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return UserType
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return UserType
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return UserType
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * @param string $bio
     * @return UserType
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     * @return UserType
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     * @return UserType
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     * @return UserType
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }
}
