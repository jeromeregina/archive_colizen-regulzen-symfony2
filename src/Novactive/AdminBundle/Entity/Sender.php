<?php

namespace Novactive\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblSender
 *
 * @ORM\Table(name="TBL_sender")
 * @ORM\Entity
 */
class Sender
{
    /**
     * @var integer
     *
     * @ORM\Column(name="SNDR_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="short_name", type="string", length=3, nullable=false)
     */
    private $shortName;

    /**
     * @var integer
     *
     * @ORM\Column(name="satus", type="integer", nullable=false, options={"default" = 0})
     */
    private $satus = 0;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Sender
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set shortName
     *
     * @param string $shortName
     * @return Sender
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }

    /**
     * Get shortName
     *
     * @return string 
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * Set satus
     *
     * @param integer $satus
     * @return Sender
     */
    public function setSatus($satus)
    {
        $this->satus = (int) $satus;

        return $this;
    }

    /**
     * Get satus
     *
     * @return integer 
     */
    public function getSatus()
    {
        return $this->satus;
    }
}
