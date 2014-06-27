<?php

namespace Colizen\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Colizen\AdminBundle\Entity\Tour;
use Colizen\AdminBundle\Entity\Parcel;
use Colizen\AdminBundle\Entity\Shipment;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @var integer
     *
     * @ORM\Column(name="EVENT_scan_status", type="integer", nullable=true)
     */
    private $scanStatus;

    /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(name="EVENT_created", type="datetime")
    */
   private $created;
   
    /**
    * @var datetime $created
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
     * Set scanStatus
     *
     * @param integer $scanStatus
     * @return Event
     */
    public function setScanStatus($scanStatus)
    {
        $this->scanStatus = $scanStatus;

        return $this;
    }

    /**
     * Get scanStatus
     *
     * @return integer
     */
    public function getScanStatus()
    {
        return $this->scanStatus;
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
}
