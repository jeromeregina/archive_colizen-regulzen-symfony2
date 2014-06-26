<?php

namespace Novactive\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Novactive\AdminBundle\Entity\Site;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Novactive\AdminBundle\Entity\DeliveryAddress;
use Novactive\AdminBundle\Entity\Tour;
use Novactive\AdminBundle\Entity\Shipment;
/**
 * TblShipment
 *
 * @ORM\Table(name="TBL_slot")})
 * @ORM\Entity(repositoryClass="Novactive\AdminBundle\Repository\Slot")
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
     * @ORM\Column(name="SLOT_delivery_slot_start", type="time", nullable=true)
     */
    private $deliverySlotStart;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="SLOT_planified_hour", type="time", nullable=true)
     */
    protected $planifiedHour;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="SLOT_delivery_slot_end", type="time", nullable=true)
     */
    private $deliverySlotEnd;
    /**
     * @var integer
     *
     * @ORM\Column(name="SLOT_tour_order", type="integer", nullable=false)
     */
    private $tourOrder;
    /**
     * @var Tour
     *
     * @ORM\ManyToOne(targetEntity="Tour", cascade={"persist"}, inversedBy="slots")
     * @ORM\JoinColumn(name="TOUR_id", referencedColumnName="TOUR_id", nullable=false)
     */
    protected $tour;
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
     * Set deliverySlotStart
     *
     * @param \DateTime $deliverySlotStart
     * @return Slot
     */
    public function setDeliverySlotStart($deliverySlotStart)
    {
        $this->deliverySlotStart = $deliverySlotStart;

        return $this;
    }

    /**
     * Get deliverySlotStart
     *
     * @return \DateTime 
     */
    public function getDeliverySlotStart()
    {
        return $this->deliverySlotStart;
    }

    /**
     * Set deliverySlotEnd
     *
     * @param \DateTime $deliverySlotEnd
     * @return Slot
     */
    public function setDeliverySlotEnd($deliverySlotEnd)
    {
        $this->deliverySlotEnd = $deliverySlotEnd;

        return $this;
    }

    /**
     * Get deliverySlotEnd
     *
     * @return \DateTime 
     */
    public function getDeliverySlotEnd()
    {
        return $this->deliverySlotEnd;
    }

    /**
     * Set tourOrder
     *
     * @param integer $tourOrder
     * @return Slot
     */
    public function setTourOrder($tourOrder)
    {
        $this->tourOrder = $tourOrder;

        return $this;
    }

    /**
     * Get tourOrder
     *
     * @return integer 
     */
    public function getTourOrder()
    {
        return $this->tourOrder;
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
     * Set tour
     *
     * @param \Novactive\AdminBundle\Entity\Tour $tour
     * @return Slot
     */
    public function setTour(\Novactive\AdminBundle\Entity\Tour $tour)
    {
        $this->tour = $tour;

        return $this;
    }

    /**
     * Get tour
     *
     * @return \Novactive\AdminBundle\Entity\Tour 
     */
    public function getTour()
    {
        return $this->tour;
    }

    /**
     * Set shipment
     *
     * @param \Novactive\AdminBundle\Entity\Shipment $shipment
     * @return Slot
     */
    public function setShipment(\Novactive\AdminBundle\Entity\Shipment $shipment)
    {
        $this->shipment = $shipment;

        return $this;
    }

    /**
     * Get shipment
     *
     * @return \Novactive\AdminBundle\Entity\Shipment 
     */
    public function getShipment()
    {
        return $this->shipment;
    }

    /**
     * Set planifiedHour
     *
     * @param \DateTime $planifiedHour
     * @return Slot
     */
    public function setPlanifiedHour($planifiedHour)
    {
        $this->planifiedHour = $planifiedHour;

        return $this;
    }

    /**
     * Get planifiedHour
     *
     * @return \DateTime 
     */
    public function getPlanifiedHour()
    {
        return $this->planifiedHour;
    }
}
