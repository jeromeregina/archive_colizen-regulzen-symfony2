<?php

namespace Colizen\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Colizen\AdminBundle\Entity\Site;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Colizen\AdminBundle\Entity\DeliveryAddress;
use Colizen\AdminBundle\Entity\Event;
use Colizen\AdminBundle\Entity\Sender;
use Colizen\AdminBundle\Entity\Slot;
/**
 * TblShipment
 *
 * @ORM\Table(name="TBL_shipment", indexes={@ORM\Index(name="fk_shipment_site1_idx", columns={"SITE_id"})})
 * @ORM\Entity(repositoryClass="Colizen\AdminBundle\Repository\Shipment")
 */
class Shipment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="SHPMNT_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="SHPMNT_cargopass", type="string", length=16, nullable=false)
     */
    private $cargopass;

    /**
     * @var Site
     *
     * @ORM\ManyToOne(targetEntity="Sender")
     * @ORM\JoinColumn(name="SNDR_id", referencedColumnName="SNDR_id", nullable=false)
     */
    private $sender;

    /**
     *
     * @ORM\OneToOne(targetEntity="DeliveryAddress", cascade={"persist"}, inversedBy="shipment")
     * @ORM\JoinColumn(name="DLVRADDR_id", referencedColumnName="DLVRADDR_id", onDelete="SET NULL")
     */
    private $deliveryAddress;
    
     /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Event", cascade={"persist"}, mappedBy="shipment")
     */
    private $events;

    /**
     * @var integer
     *
     * @ORM\Column(name="SHPMNT_parcel_quantity", type="integer", nullable=false)
     */
    private $parcelQuantity;

    /**
     * @var integer
     *
     * @ORM\Column(name="SHPMNT_service_id", type="integer", nullable=true)
     */
    private $serviceId;
    /**
     * @var integer
     *
     * @ORM\Column(name="SHPMNT_priority", type="integer", nullable=true)
     */
    private $priority;

//    /**
//     * @var \DateTime
//     *
//     * @ORM\Column(name="SHPMNT_creation_date", type="datetime", nullable=false)
//     */
//    private $creationDate;
    /**
     * @var string
     *
     * @ORM\Column(name="SHPMNT_weight", type="decimal", precision=5, scale=1, nullable=false)
     */
    private $weight;

    /**
     * @var Site
     *
     * @ORM\ManyToOne(targetEntity="Site")
     * @ORM\JoinColumn(name="SITE_id", referencedColumnName="SITE_id", nullable=false)
     */
    private $site;
    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Slot", cascade={"persist"}, mappedBy="shipment")
     */
    protected $slots;
    /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(name="SHPMNT_created", type="datetime")
    */
   private $created;

    /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="update")
    * @ORM\Column(name="SHPMNT_updated", type="datetime")
    */
   private $updated;
   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->events = new ArrayCollection();
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
     * Set cargopass
     *
     * @param string $cargopass
     * @param string $cargopassEvent
     *
     * @return Shipment
     */
    public function setCargopass($cargopass)
    {
        $this->cargopass = $cargopass;

        return $this;
    }

    /**
     * Get cargopass format 123-123-123456789 123
     *
     * @return string
     */
    public function getCargopass()
    {
        return $this->cargopass;
    }

    /**
     * Get cargopass format 1231233456789
     *
     * @return string
     */
    public function getCargopassFormatted()
    {
        $pattern = '/(\d{3})-(\d{3})-(\d{2})(\d{7}) (\d{3})/';
        $replacement = '$1$3$4';

        return preg_replace($pattern, $replacement, $this->cargopass);
    }

    /**
     * Set parcelQuantity
     *
     * @param integer $parcelQuantity
     *
     * @return Shipment
     */
    public function setParcelQuantity($parcelQuantity)
    {
        $this->parcelQuantity = $parcelQuantity;

        return $this;
    }

    /**
     * Get parcelQuantity
     *
     * @return integer
     */
    public function getParcelQuantity()
    {
        return $this->parcelQuantity;
    }

    /**
     * Set deliveryDate
     *
     * @param \DateTime $deliveryDate
     *
     * @return Shipment
     */
    public function setDeliveryDate($deliveryDate)
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
    }

    /**
     * Get deliveryDate
     *
     * @return \DateTime
     */
    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    /**
     * Set deliverySlotStart
     *
     * @param \DateTime $deliverySlotStart
     *
     * @return Shipment
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
     *
     * @return Shipment
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
     * Set serviceId
     *
     * @param integer $serviceId
     *
     * @return Shipment
     */
    public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;

        return $this;
    }

    /**
     * Get serviceId
     *
     * @return integer
     */
    public function getServiceId()
    {
        return $this->serviceId;
    }

//    /**
//     * Set creationDate
//     *
//     * @param \DateTime $creationDate
//     *
//     * @return Shipment
//     */
//    public function setCreationDate($creationDate)
//    {
//        $this->creationDate = $creationDate;
//
//        return $this;
//    }
//
//    /**
//     * Get creationDate
//     *
//     * @return \DateTime
//     */
//    public function getCreationDate()
//    {
//        return $this->creationDate;
//    }

    /**
     * Set site
     *
     * @param \Colizen\AdminBundle\Entity\Site $site
     *
     * @return Shipment
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
     * Set deliveryAddress
     *
     * @param \Colizen\AdminBundle\Entity\DeliveryAddress $deliveryAddress
     *
     * @return Shipment
     */
    public function setDeliveryAddress(DeliveryAddress $deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    /**
     * Get deliveryAddress
     *
     * @return \Colizen\AdminBundle\Entity\DeliveryAddress
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }
    /**
     * 
     * @return boolean
     */
    public function hasDeliveryAddress(){
        return ($this->getDeliveryAddress() instanceof DeliveryAddress);
    }
    /**
     * Set weight
     *
     * @param string $weight
     *
     * @return Shipment
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }


    /**
     * Add events
     *
     * @param \Colizen\AdminBundle\Entity\Event $events
     * @return Shipment
     */
    public function addEvent(Event $event)
    {
        $event->setShipment($this);
        
        $this->events->add($event);

        return $this;
    }

    /**
     * Remove events
     *
     * @param \Colizen\AdminBundle\Entity\Event $events
     */
    public function removeEvent(Event $events)
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

    /**
     * Add slots
     *
     * @param \Colizen\AdminBundle\Entity\Slot $slots
     * @return Shipment
     */
    public function addSlot(Slot $slot)
    {
        $slot->setShipment($this);
        
        $this->slots->add($slot);

        return $this;
    }

    /**
     * Remove slots
     *
     * @param \Colizen\AdminBundle\Entity\Slot $slots
     */
    public function removeSlot(Slot $slot)
    {
        $this->slots->removeElement($slots);
    }

    /**
     * Get slots
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSlots()
    {
        return $this->slots;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     * @return Shipment
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set sender
     *
     * @param \Colizen\AdminBundle\Entity\Sender $sender
     * @return Shipment
     */
    public function setSender(Sender $sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return \Colizen\AdminBundle\Entity\Sender 
     */
    public function getSender()
    {
        return $this->sender;
    }
}