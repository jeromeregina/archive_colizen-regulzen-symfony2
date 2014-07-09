<?php

namespace Regulzen\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * TblZone
 *
 * @ORM\Table(name="TBL_zone", indexes={@ORM\Index(name="fk_zone_site1_idx", columns={"SITE_id"})})
 * @ORM\Entity(repositoryClass="Regulzen\CoreBundle\Repository\Zone")
 */
class Zone
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ZONE_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ZONE_name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="ZONE_travel_time", type="integer", nullable=false, options={"default" = 45})
     */
    private $travelTime = 45;

    /**
     * @var Site
     *
     * @ORM\ManyToOne(targetEntity="Site")
     * @ORM\JoinColumn(name="SITE_id", referencedColumnName="SITE_id", nullable=false)
     */
    private $site;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="ZONE_created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="ZONE_updated", type="datetime")
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
     * @return Zone
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
     * Set travelTime
     *
     * @param integer $travelTime
     *
     * @return Zone
     */
    public function setTravelTime($travelTime)
    {
        $this->travelTime = (int) $travelTime;

        return $this;
    }

    /**
     * Get travelTime
     *
     * @return integer
     */
    public function getTravelTime()
    {
        return $this->travelTime;
    }

    /**
     * Set site
     *
     * @param \Regulzen\CoreBundle\Entity\Site $site
     *
     * @return Zone
     */
    public function setSite(Site $site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return \Regulzen\CoreBundle\Entity\Site
     */
    public function getSite()
    {
        return $this->site;
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
}
