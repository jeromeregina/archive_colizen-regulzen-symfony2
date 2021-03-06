<?php

namespace Colizen\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Colizen\AdminBundle\Entity\Tour;
use Colizen\AdminBundle\Entity\Parcel;
use Colizen\AdminBundle\Entity\Shipment;
use Doctrine\Common\Collections\ArrayCollection;
use Colizen\AdminBundle\Entity\Slot;

/**
 * TblEvent
 *
 * @ORM\Table(name="TBL_event")
 * @ORM\Entity(repositoryClass="Colizen\AdminBundle\Repository\Event")
 */
class Event
{
    /**
     * @var integer
     *
     * @ORM\Column(name="EVENT_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Parcel
     *
     * @ORM\ManyToOne(targetEntity="Parcel", inversedBy="events")
     * @ORM\JoinColumn(name="PRCL_id", referencedColumnName="PRCL_id", nullable=true)
     */
    protected $parcel;

    /**
     * @var Shipment
     *
     * @ORM\ManyToOne(targetEntity="Shipment", inversedBy="events")
     * @ORM\JoinColumn(name="SHPMNT_id", referencedColumnName="SHPMNT_id", nullable=true)
     */
    protected $shipment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="EVENT_date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="EVENT_scan_hour", type="time", nullable=true)
     */
    private $scanHour;
    
    /**
     * @var Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumn(name="STATUS_code", referencedColumnName="STATUS_code", nullable=true)
     */
    protected $scanStatus;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="STATUS_code", type="integer", nullable=true)
     */
    protected $scanStatusCode;

    /**
    * @var Slot
    *
    * @ORM\ManyToOne(targetEntity="Slot", inversedBy="events")
    * @ORM\JoinColumn(name="SLOT_id", referencedColumnName="SLOT_id", nullable=true)
    */
   private $slot;
   
    /**
    * @var \DateTime $created
    *
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(name="EVENT_created", type="datetime")
    */
   private $created;
   
    /**
    * @var \DateTime $created
    *
    * @Gedmo\Timestampable(on="update")
    * @ORM\Column(name="EVENT_updated", type="datetime")
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Event
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
     * Set scanHour
     *
     * @param \DateTime $scanHour
     * @return Event
     */
    public function setScanHour($scanHour)
    {
        $this->scanHour = $scanHour;

        return $this;
    }

    /**
     * Get scanHour
     *
     * @return \DateTime
     */
    public function getScanHour()
    {
        return $this->scanHour;
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
     * Set shipment
     *
     * @param \Colizen\AdminBundle\Entity\Shipment $shipment
     *
     * @return Event
     */
    public function setShipment(Shipment $shipment = null)
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
     * Set parcel
     *
     * @param \Colizen\AdminBundle\Entity\Parcel $parcel
     * @return Event
     */
    public function setParcel(\Colizen\AdminBundle\Entity\Parcel $parcel = null)
    {
        $this->parcel = $parcel;

        return $this;
    }

    /**
     * Get parcel
     *
     * @return \Colizen\AdminBundle\Entity\Parcel 
     */
    public function getParcel()
    {
        return $this->parcel;
    }

    /**
     * Set slot
     *
     * @param \Colizen\AdminBundle\Entity\Slot $slot
     * @return Event
     */
    public function setSlot(\Colizen\AdminBundle\Entity\Slot $slot = null)
    {
        $this->slot = $slot;

        return $this;
    }

    /**
     * Get slot
     *
     * @return \Colizen\AdminBundle\Entity\Slot 
     */
    public function getSlot()
    {
        return $this->slot;
    }

    /**
     * Set scanStatus
     *
     * @param \Colizen\AdminBundle\Entity\Status $scanStatus
     * @return Event
     */
    public function setScanStatus(\Colizen\AdminBundle\Entity\Status $scanStatus = null)
    {
        $this->scanStatus = $scanStatus;

        return $this;
    }

    /**
     * Get scanStatus
     *
     * @return \Colizen\AdminBundle\Entity\Status 
     */
    public function getScanStatus()
    {
        return $this->scanStatus;
    }

    /**
     * Set scanStatusCode
     *
     * @param integer $scanStatusCode
     * @return Event
     */
    public function setScanStatusCode($scanStatusCode)
    {
        $this->scanStatusCode = $scanStatusCode;

        return $this;
    }

    /**
     * Get scanStatusCode
     *
     * @return integer 
     */
    public function getScanStatusCode()
    {
        return $this->scanStatusCode;
    }
}
