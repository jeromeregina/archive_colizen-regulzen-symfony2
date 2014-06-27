<?php

namespace Colizen\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * TblCycle
 *
 * @ORM\Table(name="TBL_tour")
 * @ORM\Entity(repositoryClass="Colizen\AdminBundle\Repository\Tour")
 */
class Tour
{
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
     * @ORM\ManyToOne(targetEntity="TourCode", cascade={"persist"}, inversedBy="tours")
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
     *
     * @ORM\OneToMany(targetEntity="Slot", mappedBy="realTour")
     */
    protected $realSlots;
    /**
     *
     * @ORM\OneToMany(targetEntity="Slot", mappedBy="theoricalTour")
     */
    protected $theoricalSlots;

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

    public function __construct()
    {
        $this->slots = new ArrayCollection();
    }

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
     *
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
     *
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
     *
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
     * @param \Colizen\AdminBundle\Entity\TourCode $tourCode
     *
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
     * @return \Colizen\AdminBundle\Entity\TourCode
     */
    public function getTourCode()
    {
        return $this->tourCode;
    }

    /**
     * Set site
     *
     * @param \Colizen\AdminBundle\Entity\Site $site
     *
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
     * @return \Colizen\AdminBundle\Entity\Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Get all slots (result from merge, non persistent collection)
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSlots()
    {
        return new ArrayCollection(
                array_merge($this->realSlots->toArray(), $this->theoricalSlots->toArray())
                );
    }

    /**
     * Add realSlots
     *
     * @param \Colizen\AdminBundle\Entity\Slot $realSlots
     * @return Tour
     */
    public function addRealSlot(\Colizen\AdminBundle\Entity\Slot $realSlots)
    {
        $this->realSlots[] = $realSlots;

        return $this;
    }

    /**
     * Remove realSlots
     *
     * @param \Colizen\AdminBundle\Entity\Slot $realSlots
     */
    public function removeRealSlot(\Colizen\AdminBundle\Entity\Slot $realSlots)
    {
        $this->realSlots->removeElement($realSlots);
    }

    /**
     * Get realSlots
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRealSlots()
    {
        return $this->realSlots;
    }

    /**
     * Add theoricalSlots
     *
     * @param \Colizen\AdminBundle\Entity\Slot $theoricalSlots
     * @return Tour
     */
    public function addTheoricalSlot(\Colizen\AdminBundle\Entity\Slot $theoricalSlots)
    {
        $this->theoricalSlots[] = $theoricalSlots;

        return $this;
    }

    /**
     * Remove theoricalSlots
     *
     * @param \Colizen\AdminBundle\Entity\Slot $theoricalSlots
     */
    public function removeTheoricalSlot(\Colizen\AdminBundle\Entity\Slot $theoricalSlots)
    {
        $this->theoricalSlots->removeElement($theoricalSlots);
    }

    /**
     * Get theoricalSlots
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTheoricalSlots()
    {
        return $this->theoricalSlots;
    }
}
