<?php

namespace Hellcat\Tools\UserBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class UserApiToken
 *
 * @ORM\Table(name="user_api_token")
 * @ORM\Entity(repositoryClass="Hellcat\Tools\UserBundle\Repository\User\UserApiTokenRepository")
 *
 * @package Hellcat\Tools\UserBundle\Entity\User
 */
class UserApiToken
{
    /**
     * @var string
     *
     * @ORM\Column(name="token_id", type="string", length=64)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $tokenId;

    /**
     * @var string
     *
     * @ORM\Column(name="token_identifier", type="string", length=128)
     */
    private $tokenIdentifier;

    /**
     * @var string
     *
     * @ORM\Column(name="token_type", type="string", length=16)
     */
    private $tokenType;

    /**
     * @var string
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=256)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="rate_limit_count", type="integer")
     */
    private $rateLimitCount;

    /**
     * @var integer
     *
     * @ORM\Column(name="rate_limit_time", type="integer")
     */
    private $rateLimitTime;

    /**
     * @var UserApiTokenAssign[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="UserApiTokenAssign", mappedBy="token")
     */
    private $userTokenAssigns;

    /**
     * UserApiToken constructor.
     */
    public function __construct()
    {
        $this->userTokenAssigns = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getTokenId()
    {
        return $this->tokenId;
    }

    /**
     * @param string $tokenId
     * @return UserApiToken
     */
    public function setTokenId($tokenId)
    {
        $this->tokenId = $tokenId;
        return $this;
    }

    /**
     * @return string
     */
    public function getTokenIdentifier()
    {
        return $this->tokenIdentifier;
    }

    /**
     * @param string $tokenIdentifier
     * @return UserApiToken
     */
    public function setTokenIdentifier($tokenIdentifier)
    {
        $this->tokenIdentifier = $tokenIdentifier;
        return $this;
    }

    /**
     * @return string
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }

    /**
     * @param string $tokenType
     * @return UserApiToken
     */
    public function setTokenType($tokenType)
    {
        $this->tokenType = $tokenType;
        return $this;
    }

    /**
     * @return string
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param string $enabled
     * @return UserApiToken
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return UserApiToken
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return ArrayCollection|UserApiTokenAssign[]
     */
    public function getUserTokenAssigns()
    {
        return $this->userTokenAssigns;
    }

    /**
     * @param UserApiTokenAssign $userTokenAssign
     * @return UserApiToken
     */
    public function addUserTokenAssign($userTokenAssign)
    {
        $this->userTokenAssigns->add($userTokenAssign);
        return $this;
    }

    /**
     * @return int
     */
    public function getRateLimitCount()
    {
        return $this->rateLimitCount;
    }

    /**
     * @param int $rateLimitCount
     * @return UserApiToken
     */
    public function setRateLimitCount($rateLimitCount)
    {
        $this->rateLimitCount = $rateLimitCount;
        return $this;
    }

    /**
     * @return int
     */
    public function getRateLimitTime()
    {
        return $this->rateLimitTime;
    }

    /**
     * @param int $rateLimitTime
     * @return UserApiToken
     */
    public function setRateLimitTime($rateLimitTime)
    {
        $this->rateLimitTime = $rateLimitTime;
        return $this;
    }
}
