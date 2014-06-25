<?php

namespace Novactive\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Novactive\AdminBundle\Entity\Cycle;
use Novactive\AdminBundle\Entity\TourCode;
use Novactive\AdminBundle\Entity\Shipment;
use Novactive\AdminBundle\Entity\Site;

/**
 * TblCycle
 *
 * @ORM\Table(name="TBL_tour")
 * @ORM\Entity(repositoryClass="Novactive\AdminBundle\Repository\Tour")
 */
class Tour {
    /**
     * @var integer
     *
     * @ORM\Column(name="TOUR_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
     /**
     * @var TourCode
     *
     * @ORM\ManyToOne(targetEntity="TourCode", inversedBy="tours")
     * @ORM\JoinColumn(name="TOURCODE_id", referencedColumnName="TOURCODE_id", nullable=false)
     */
    protected $tourCode;
    
     /**
     * @var Site
     *
     * @ORM\ManyToOne(targetEntity="Site", inversedBy="tours")
     * @ORM\JoinColumn(name="SITE_id", referencedColumnName="SITE_id", nullable=false)
     */
    protected $site;
    
   /**
    * @var datetime $date
    *
    * @ORM\Column(name="TOUR_date", type="datetime")
    */
   protected $date;
    
   /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(name="TOUR_created", type="datetime")
    */
   protected $created;
   
    /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="update")
    * @ORM\Column(name="TOUR_updated", type="datetime")
    */
   protected $updated;

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
     * Set date
     *
     * @param \DateTime $date
     * @return Tour
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Tour
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
     * @return Tour
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
     * Set tourCode
     *
     * @param \Novactive\AdminBundle\Entity\TourCode $tourCode
     * @return Tour
     */
    public function setTourCode(TourCode $tourCode)
    {
        $this->tourCode = $tourCode;

        return $this;
    }

    /**
     * Get tourCode
     *
     * @return \Novactive\AdminBundle\Entity\TourCode 
     */
    public function getTourCode()
    {
        return $this->tourCode;
    }

    /**
     * Set site
     *
     * @param \Novactive\AdminBundle\Entity\Site $site
     * @return Tour
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
