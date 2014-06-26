<?php

namespace Novactive\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * TblSender
 *
 * @ORM\Table(name="TBL_sender")
 * @ORM\Entity(repositoryClass="Novactive\AdminBundle\Repository\Sender")
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
     * @ORM\Column(name="SNDR_name", type="string", length=255, nullable=true)
     */
    private $name;

  /**
     * @var Site
     *
     * @ORM\ManyToOne(targetEntity="Site")
     * @ORM\JoinColumn(name="SITE_id", referencedColumnName="SITE_id", nullable=false)
     */
    protected $site;

    /**
     * @var string
     *
     * @ORM\Column(name="SNDR_code", type="string", length=6, nullable=false)
     */
    private $code;

    /**
     * @var integer
     *
     * @ORM\Column(name="SNDR_status", type="integer", nullable=false, options={"default" = 0})
     */
    private $status = 0;
    /**
     * @var integer
     *
     * @ORM\Column(name="SNDR_sensitivity", type="integer", nullable=false, options={"default" = 2})
     */
    private $sensitivity = 2;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="SNDR_created", type="datetime")
     */
    private $created;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="SNDR_updated", type="datetime")
     */
    private $updated;

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
     *
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
     *
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
     * @param integer $tatus
     *
     * @return Sender
     */
    public function setStatus($status)
    {
        $this->status = (int) $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Parcel
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Parcel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     *
     * @param string $code
     *
     * @return \Novactive\AdminBundle\Entity\Sender
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     *
     * @return int
     */
    public function getSensitivity()
    {
        return $this->sensitivity;
    }

    /**
     *
     * @param int $sensitivity
     *
     * @return \Novactive\AdminBundle\Entity\Sender
     */
    public function setSensitivity($sensitivity)
    {
        $this->sensitivity = $sensitivity;

        return $this;
    }


    /**
     * Set site
     *
     * @param \Novactive\AdminBundle\Entity\Site $site
     * @return Sender
     */
    public function setSite(\Novactive\AdminBundle\Entity\Site $site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return \Novactive\AdminBundle\Entity\Site 
     */
    public function getSite()
    {
        return $this->site;
    }
}
