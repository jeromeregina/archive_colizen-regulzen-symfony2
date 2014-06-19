<?php

namespace Novactive\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Novactive\AdminBundle\Entity\Site;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * TblZone
 *
 * @ORM\Table(name="TBL_zone", indexes={@ORM\Index(name="fk_zone_site1_idx", columns={"SITE_id"})})
 * @ORM\Entity(repositoryClass="Novactive\AdminBundle\Repository\Zone")
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
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="SITE_id", referencedColumnName="SITE_id", nullable=false)
     * })
     */
    private $site;

    /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(name="ZONE_created", type="datetime")
    */
   private $created;
   
    /**
    * @var datetime $created
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
     * @param \Novactive\AdminBundle\Entity\Site $site
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
     * @return \Novactive\AdminBundle\Entity\Site 
     */
    public function getSite()
    {
        return $this->site;
    }
}
