<?php

namespace Novactive\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * TblEvent
 *
 * @ORM\Table(name="TBL_event")
 * @ORM\Entity(repositoryClass="Novactive\AdminBundle\Repository\Event")
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
     * @var string
     *
     * @ORM\Column(name="EVENT_cargopass_event", type="string", length=9, nullable=false)
     */
    private $cargopassEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="EVENT_cargopass_parcel", type="string", length=8, nullable=false)
     */
    private $cargopassParcel;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="EVENT_date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="EVENT_tour_code", type="string", length=3, nullable=false)
     */
    private $tourCode;

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
     * @var \DateTime
     *
     * @ORM\Column(name="EVENT_theorical_hour", type="time", nullable=false)
     */
    private $theoricalHour;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="EVENT_meeting_hour_start", type="time", nullable=false)
     */
    private $meetingHourStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="EVENT_meeting_hour_end", type="time", nullable=false)
     */
    private $meetingHourEnd;

    /**
     * @var integer
     *
     * @ORM\Column(name="EVENT_tour_order", type="integer", nullable=false)
     */
    private $tourOrder;

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
     * Set cargopassEvent
     *
     * @param string $cargopassEvent
     * @return Event
     */
    public function setCargopassEvent($cargopassEvent)
    {
        $this->cargopassEvent = $cargopassEvent;

        return $this;
    }

    /**
     * Get cargopassEvent
     *
     * @return string 
     */
    public function getCargopassEvent()
    {
        return $this->cargopassEvent;
    }

    /**
     * Set cargopassParcel
     *
     * @param string $cargopassParcel
     * @return Event
     */
    public function setCargopassParcel($cargopassParcel)
    {
        $this->cargopassParcel = $cargopassParcel;

        return $this;
    }

    /**
     * Get cargopassParcel
     *
     * @return string 
     */
    public function getCargopassParcel()
    {
        return $this->cargopassParcel;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
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
     * Set tourCode
     *
     * @param string $tourCode
     * @return Event
     */
    public function setTourCode($tourCode)
    {
        $this->tourCode = $tourCode;

        return $this;
    }

    /**
     * Get tourCode
     *
     * @return string 
     */
    public function getTourCode()
    {
        return $this->tourCode;
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
     * Set theoricalHour
     *
     * @param \DateTime $theoricalHour
     * @return Event
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
     * Set meetingHourStart
     *
     * @param \DateTime $meetingHourStart
     * @return Event
     */
    public function setMeetingHourStart($meetingHourStart)
    {
        $this->meetingHourStart = $meetingHourStart;

        return $this;
    }

    /**
     * Get meetingHourStart
     *
     * @return \DateTime 
     */
    public function getMeetingHourStart()
    {
        return $this->meetingHourStart;
    }

    /**
     * Set meetingHourEnd
     *
     * @param \DateTime $meetingHourEnd
     * @return Event
     */
    public function setMeetingHourEnd($meetingHourEnd)
    {
        $this->meetingHourEnd = $meetingHourEnd;

        return $this;
    }

    /**
     * Get meetingHourEnd
     *
     * @return \DateTime 
     */
    public function getMeetingHourEnd()
    {
        return $this->meetingHourEnd;
    }

    /**
     * Set tourOrder
     *
     * @param integer $tourOrder
     * @return Event
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
