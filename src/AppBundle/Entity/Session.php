<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Session
 *
 * @ORM\Table(name="sessions", indexes={@ORM\Index(name="sess_id_idx", columns={"sess_id"}), @ORM\Index(name="sess_time_idx", columns={"sess_time"}), @ORM\Index(name="sess_lifetime_idx", columns={"sess_lifetime"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SessionRepository")
 *
 * @package AppBundle\Entity
 */
class Session
{
    /**
     * @var string
     *
     * @ORM\Column(name="sess_id", type="string", length=128)
     * @ORM\Id
     */
    private $sessId;

    /**
     * @var resource
     *
     * @ORM\Column(name="sess_data", type="blob", nullable=true)
     */
    private $sessData;

    /**
     * @var integer
     *
     * @ORM\Column(name="sess_time", type="integer")
     */
    private $sessTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="sess_lifetime", type="integer")
     */
    private $sessLifetime;

    /**
     * @return string
     */
    public function getSessId()
    {
        return $this->sessId;
    }

    /**
     * @param string $sessId
     * @return Session
     */
    public function setSessId($sessId)
    {
        $this->sessId = $sessId;
        return $this;
    }

    /**
     * @return resource
     */
    public function getSessData()
    {
        return $this->sessData;
    }

    /**
     * @param resource $sessData
     * @return Session
     */
    public function setSessData($sessData)
    {
        $this->sessData = $sessData;
        return $this;
    }

    /**
     * @return int
     */
    public function getSessTime()
    {
        return $this->sessTime;
    }

    /**
     * @param int $sessTime
     * @return Session
     */
    public function setSessTime($sessTime)
    {
        $this->sessTime = $sessTime;
        return $this;
    }

    /**
     * @return int
     */
    public function getSessLifetime()
    {
        return $this->sessLifetime;
    }

    /**
     * @param int $sessLifetime
     * @return Session
     */
    public function setSessLifetime($sessLifetime)
    {
        $this->sessLifetime = $sessLifetime;
        return $this;
    }
}
