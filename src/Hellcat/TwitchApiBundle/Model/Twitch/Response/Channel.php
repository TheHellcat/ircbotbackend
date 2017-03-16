<?php

namespace Hellcat\TwitchApiBundle\Model\Twitch\Response;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class Channel
 * @package Hellcat\TwitchApiBundle\Model\Twitch\Response
 */
final class Channel
{
    /**
     * @Serializer\SerializedName("_id")
     * @Serializer\Type("integer")
     *
     * @var integer
     */
    private $id;

    /**
     * @Serializer\SerializedName("broadcaster_language")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $broadcasterLanguage;

    /**
     * @Serializer\SerializedName("created_at")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $createdAt;

    /**
     * @Serializer\SerializedName("display_name")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $displayName;

    /**
     * @Serializer\SerializedName("email")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $email;

    /**
     * @Serializer\SerializedName("followers")
     * @Serializer\Type("integer")
     *
     * @var integer
     */
    private $followers;

    /**
     * @Serializer\SerializedName("game")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $game;

    /**
     * @Serializer\SerializedName("language")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $language;

    /**
     * @Serializer\SerializedName("logo")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $logo;

    /**
     * @Serializer\SerializedName("mature")
     * @Serializer\Type("boolean")
     *
     * @var boolean
     */
    private $mature;

    /**
     * @Serializer\SerializedName("name")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $name;

    /**
     * @Serializer\SerializedName("partner")
     * @Serializer\Type("boolean")
     *
     * @var boolean
     */
    private $partner;

    /**
     * @Serializer\SerializedName("profile_banner")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $profileBanner;

    /**
     * @Serializer\SerializedName("profile_banner_background_color")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $profileBannerBackgroundColor;

    /**
     * @Serializer\SerializedName("status")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $status;

    /**
     * @Serializer\SerializedName("stream_key")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $streamKey;

    /**
     * @Serializer\SerializedName("updated_at")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $updatedAt;

    /**
     * @Serializer\SerializedName("")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $url;

    /**
     * @Serializer\SerializedName("")
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $videoBanner;

    /**
     * @Serializer\SerializedName("")
     * @Serializer\Type("integer")
     *
     * @var integer
     */
    private $views;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Channel
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getBroadcasterLanguage()
    {
        return $this->broadcasterLanguage;
    }

    /**
     * @param string $broadcasterLanguage
     * @return Channel
     */
    public function setBroadcasterLanguage($broadcasterLanguage)
    {
        $this->broadcasterLanguage = $broadcasterLanguage;
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
     * @return Channel
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param string $displayName
     * @return Channel
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
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
     * @return Channel
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return int
     */
    public function getFollowers()
    {
        return $this->followers;
    }

    /**
     * @param int $followers
     * @return Channel
     */
    public function setFollowers($followers)
    {
        $this->followers = $followers;
        return $this;
    }

    /**
     * @return string
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @param string $game
     * @return Channel
     */
    public function setGame($game)
    {
        $this->game = $game;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return Channel
     */
    public function setLanguage($language)
    {
        $this->language = $language;
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
     * @return Channel
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * @return bool
     */
    public function isMature()
    {
        return $this->mature;
    }

    /**
     * @param bool $mature
     * @return Channel
     */
    public function setMature($mature)
    {
        $this->mature = $mature;
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
     * @return Channel
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPartner()
    {
        return $this->partner;
    }

    /**
     * @param bool $partner
     * @return Channel
     */
    public function setPartner($partner)
    {
        $this->partner = $partner;
        return $this;
    }

    /**
     * @return string
     */
    public function getProfileBanner()
    {
        return $this->profileBanner;
    }

    /**
     * @param string $profileBanner
     * @return Channel
     */
    public function setProfileBanner($profileBanner)
    {
        $this->profileBanner = $profileBanner;
        return $this;
    }

    /**
     * @return string
     */
    public function getProfileBannerBackgroundColor()
    {
        return $this->profileBannerBackgroundColor;
    }

    /**
     * @param string $profileBannerBackgroundColor
     * @return Channel
     */
    public function setProfileBannerBackgroundColor($profileBannerBackgroundColor)
    {
        $this->profileBannerBackgroundColor = $profileBannerBackgroundColor;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Channel
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreamKey()
    {
        return $this->streamKey;
    }

    /**
     * @param string $streamKey
     * @return Channel
     */
    public function setStreamKey($streamKey)
    {
        $this->streamKey = $streamKey;
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
     * @return Channel
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Channel
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getVideoBanner()
    {
        return $this->videoBanner;
    }

    /**
     * @param string $videoBanner
     * @return Channel
     */
    public function setVideoBanner($videoBanner)
    {
        $this->videoBanner = $videoBanner;
        return $this;
    }

    /**
     * @return int
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * @param int $views
     * @return Channel
     */
    public function setViews($views)
    {
        $this->views = $views;
        return $this;
    }
}
