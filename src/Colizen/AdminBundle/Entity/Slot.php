<?php

namespace Colizen\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Colizen\AdminBundle\Entity\Site;
use Doctrine\Common\Collections\ArrayCollection;
use Colizen\AdminBundle\Entity\DeliveryAddress;
use Colizen\AdminBundle\Entity\Tour;
use Colizen\AdminBundle\Entity\Shipment;
use Colizen\AdminBundle\Entity\Event;
/**
 * TblShipment
 *
 * @ORM\Table(name="TBL_slot")})
 * @ORM\Entity(repositoryClass="Colizen\AdminBundle\Repository\Slot")
 */
class Slot {
   /**
     * @var integer
     *
     * @ORM\Column(name="SLOT_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="SLOT_theorical_hour", type="time", nullable=true)
     */
    protected $theoricalHour;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="SLOT_real_hour", type="time", nullable=true)
     */
    protected $realHour;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="SLOT_real_slot_start", type="time", nullable=true)
     */
    private $realSlotStart;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="SLOT_real_slot_end", type="time", nullable=true)
     */
    private $realSlotEnd;
    /**
     * @var integer
     *
     * @ORM\Column(name="SLOT_real_tour_order", type="integer", nullable=true)
     */
    private $realTourOrder;
    /**
     * @var integer
     *
     * @ORM\Column(name="SLOT_real_update_counter", type="integer", nullable=true)
     */
    private $realUpdateCounter;
    /**
     * @var Tour
     *
     * @ORM\ManyToOne(targetEntity="Tour", cascade={"persist"}, inversedBy="realSlots")
     * @ORM\JoinColumn(name="SLOT_real_TOUR_id", referencedColumnName="TOUR_id", nullable=true)
     */
    protected $realTour;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="SLOT_theorical_slot_start", type="time", nullable=true)
     */
    private $theoricalSlotStart;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="SLOT_theorical_slot_end", type="time", nullable=true)
     */
    private $theoricalSlotEnd;
    /**
     * @var integer
     *
     * @ORM\Column(name="SLOT_theorical_tour_order", type="integer", nullable=false)
     */
    private $theoricalTourOrder;
    /**
     * @var Tour
     *
     * @ORM\ManyToOne(targetEntity="Tour", cascade={"persist"}, inversedBy="theoricalSlots")
     * @ORM\JoinColumn(name="SLOT_theorical_TOUR_id", referencedColumnName="TOUR_id", nullable=true)
     */
    protected $theoricalTour;
    
    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="slot")
     */
    private  $events;
    
    /**
     * @var Shipment
     *
     * @ORM\ManyToOne(targetEntity="Shipment", inversedBy="slots")
     * @ORM\JoinColumn(name="SHPMNT_id", referencedColumnName="SHPMNT_id", nullable=false)
     */
    protected $shipment;
    /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(name="SLOT_created", type="datetime")
    */
    private $created;

    /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="update")
    * @ORM\Column(name="SLOT_updated", type="datetime")
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
     * Set created
     *
     * @param \DateTime $created
     * @return Slot
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
     * @return Slot
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
     * Set shipment
     *
     * @param \Colizen\AdminBundle\Entity\Shipment $shipment
     * @return Slot
     */
    public function setShipment(\Colizen\AdminBundle\Entity\Shipment $shipment)
    {
        $this->shipment = $shipment;

        return $this;
    }

    /**
     * Get shipment
     *
     * @return \Colizen\AdminBundle\Entity\Shipment 
     */
    public function getShipment()
    {
        return $this->shipment;
    }

    /**
     * Set theoricalHour
     *
     * @param \DateTime $theoricalHour
     * @return Slot
     */
    public function setTheoricalHour($theoricalHour)
    {
        $this->theoricalHour = $theoricalHour;

        return $this;
    }

    /**
     * Get theoricalHour
     *
     * @return \DateTime 
     */
    public function getTheoricalHour()
    {
        return $this->theoricalHour;
    }

    /**
     * Set realSlotStart
     *
     * @param \DateTime $realSlotStart
     * @return Slot
     */
    public function setRealSlotStart($realSlotStart)
    {
        $this->realSlotStart = $realSlotStart;

        return $this;
    }

    /**
     * Get realSlotStart
     *
     * @return \DateTime 
     */
    public function getRealSlotStart()
    {
        return $this->realSlotStart;
    }

    /**
     * Set realSlotEnd
     *
     * @param \DateTime $realSlotEnd
     * @return Slot
     */
    public function setRealSlotEnd($realSlotEnd)
    {
        $this->realSlotEnd = $realSlotEnd;

        return $this;
    }

    /**
     * Get realSlotEnd
     *
     * @return \DateTime 
     */
    public function getRealSlotEnd()
    {
        return $this->realSlotEnd;
    }

    /**
     * Set realTourOrder
     *
     * @param integer $realTourOrder
     * @return Slot
     */
    public function setRealTourOrder($realTourOrder)
    {
        $this->realTourOrder = $realTourOrder;

        return $this;
    }

    /**
     * Get realTourOrder
     *
     * @return integer 
     */
    public function getRealTourOrder()
    {
        return $this->realTourOrder;
    }

    /**
     * Set realUpdateCounter
     *
     * @param integer $realUpdateCounter
     * @return Slot
     */
    public function setRealUpdateCounter($realUpdateCounter)
    {
        $this->realUpdateCounter = $realUpdateCounter;

        return $this;
    }

    /**
     * Get realUpdateCounter
     *
     * @return integer 
     */
    public function getRealUpdateCounter()
    {
        return $this->realUpdateCounter;
    }

    /**
     * Set theoricalSlotStart
     *
     * @param \DateTime $theoricalSlotStart
     * @return Slot
     */
    public function setTheoricalSlotStart($theoricalSlotStart)
    {
        $this->theoricalSlotStart = $theoricalSlotStart;

        return $this;
    }

    /**
     * Get theoricalSlotStart
     *
     * @return \DateTime 
     */
    public function getTheoricalSlotStart()
    {
        return $this->theoricalSlotStart;
    }

    /**
     * Set theoricalSlotEnd
     *
     * @param \DateTime $theoricalSlotEnd
     * @return Slot
     */
    public function setTheoricalSlotEnd($theoricalSlotEnd)
    {
        $this->theoricalSlotEnd = $theoricalSlotEnd;

        return $this;
    }

    /**
     * Get theoricalSlotEnd
     *
     * @return \DateTime 
     */
    public function getTheoricalSlotEnd()
    {
        return $this->theoricalSlotEnd;
    }

    /**
     * Set theoricalTourOrder
     *
     * @param integer $theoricalTourOrder
     * @return Slot
     */
    public function setTheoricalTourOrder($theoricalTourOrder)
    {
        $this->theoricalTourOrder = $theoricalTourOrder;

        return $this;
    }

    /**
     * Get theoricalTourOrder
     *
     * @return integer 
     */
    public function getTheoricalTourOrder()
    {
        return $this->theoricalTourOrder;
    }

    /**
     * Set realTour
     *
     * @param \Colizen\AdminBundle\Entity\Tour $realTour
     * @return Slot
     */
    public function setRealTour(Tour $realTour)
    {
        $this->realTour = $realTour;

        return $this;
    }

    /**
     * Get realTour
     *
     * @return \Colizen\AdminBundle\Entity\Tour 
     */
    public function getRealTour()
    {
        return $this->realTour;
    }

    /**
     * Set theoricalTour
     *
     * @param \Colizen\AdminBundle\Entity\Tour $theoricalTour
     * @return Slot
     */
    public function setTheoricalTour(Tour $theoricalTour)
    {
        $this->theoricalTour = $theoricalTour;

        return $this;
    }

    /**
     * Get theoricalTour
     *
     * @return \Colizen\AdminBundle\Entity\Tour 
     */
    public function getTheoricalTour()
    {
        return $this->theoricalTour;
    }

    /**
     * Set realHour
     *
     * @param \DateTime $realHour
     * @return Slot
     */
    public function setRealHour($realHour)
    {
        $this->realHour = $realHour;

        return $this;
    }

    /**
     * Get realHour
     *
     * @return \DateTime 
     */
    public function getRealHour()
    {
        return $this->realHour;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add events
     *
     * @param \Colizen\AdminBundle\Entity\Event $events
     * @return Slot
     */
    public function addEvent(\Colizen\AdminBundle\Entity\Event $events)
    {
        $this->events[] = $events;

        return $this;
    }

    /**
     * Remove events
     *
     * @param \Colizen\AdminBundle\Entity\Event $events
     */
    public function removeEvent(\Colizen\AdminBundle\Entity\Event $events)
    {
        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }
}
