<?php

namespace Regulzen\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Regulzen\UserBundle\Entity\User;

/**
 * TblCycle
 *
 * @ORM\Table(name="TBL_session")
 * @ORM\Entity
 */
class Session
{
    /**
     * @var integer
     *
     * @ORM\Column(name="SESSION_id", type="string", length=255, nullable=false)
     * @ORM\Id
     */
    private $id;
    /**
     *
     * @var string
     * @ORM\Column(name="SESSION_value", type="text",nullable=false)
     */
    private $value;
    /**
     *
     * @var integer
     * @ORM\Column(name="SESSION_time", type="integer",nullable=false)
     */
    private $time;
    /**
     * @var  \Regulzen\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="\Regulzen\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="USR_id", referencedColumnName="USR_id", nullable=true)
     * })
     *
     */
    private $user;

    /**
     * Set id
     *
     * @param string $id
     *
     * @return Session
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return Session
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set time
     *
     * @param integer $time
     *
     * @return Session
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return integer
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set user
     *
     * @param \Regulzen\UserBundle\Entity\User $user
     *
     * @return Session
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Regulzen\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
