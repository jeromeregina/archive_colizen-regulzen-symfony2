<?php

namespace Regulzen\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * TblShipment
 *
 * @ORM\Table(name="TBL_shipment", indexes={@ORM\Index(name="fk_shipment_site1_idx", columns={"SITE_id"})})
 * @ORM\Entity(repositoryClass="Regulzen\CoreBundle\Repository\Shipment")
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
     * @ORM\Column(name="SHPMNT_cargopass", type="string", length=21, nullable=false)
     */
    private $cargopass;

    /**
     * @var Site
     *
     * @ORM\ManyToOne(targetEntity="ShipperAccount", cascade={"persist"})
     * @ORM\JoinColumn(name="SHPR_id", referencedColumnName="SHPR_id", nullable=false)
     */
    private $shipperAccount;

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
     * @ORM\OrderBy({"created" = "ASC"})
     */
    protected $slots;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Parcel", cascade={"persist"}, mappedBy="shipment")
     *
     */
    protected $parcels;

    /**
    * @var \DateTime $created
    *
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(name="SHPMNT_created", type="datetime")
    */
   private $created;

    /**
    * @var \DateTime $created
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
        $this->parcels = new ArrayCollection();
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

    /**
     * Set site
     *
     * @param \Regulzen\CoreBundle\Entity\Site $site
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

    /**
     * Set deliveryAddress
     *
     * @param \Regulzen\CoreBundle\Entity\DeliveryAddress $deliveryAddress
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
     * @return \Regulzen\CoreBundle\Entity\DeliveryAddress
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }
    /**
     *
     * @return boolean
     */
    public function hasDeliveryAddress()
    {
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
     * @param  \Regulzen\CoreBundle\Entity\Event $events
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
     * @param \Regulzen\CoreBundle\Entity\Event $events
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
     * @param  \Regulzen\CoreBundle\Entity\Slot $slots
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
     * @param \Regulzen\CoreBundle\Entity\Slot $slots
     */
    public function removeSlot(Slot $slot)
    {
        $this->slots->removeElement($slot);
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
     * Get slot
     *
     * @return \Regulzen\CoreBundle\Entity\Slot
     */
    public function getLastSlot()
    {
        return $this->slots->last();
    }
    /**
     *
     * @return boolean
     */
    public function hasSlots()
    {
        return !$this->slots->isEmpty();
    }

    /**
     * Set priority
     *
     * @param  integer  $priority
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
     * Set shipperAccount
     *
     * @param  \Regulzen\CoreBundle\Entity\ShipperAccount $shipperAccount
     * @return Shipment
     */
    public function setShipperAccount(ShipperAccount $shipperAccount)
    {
        $this->shipperAccount = $shipperAccount;

        return $this;
    }

    /**
     * Get shipperAccount
     *
     * @return \Regulzen\CoreBundle\Entity\ShipperAccount
     */
    public function getShipperAccount()
    {
        return $this->shipperAccount;
    }

    /**
     * Add parcels
     *
     * @param  \Regulzen\CoreBundle\Entity\Parcel $parcels
     * @return Shipment
     */
    public function addParcel(\Regulzen\CoreBundle\Entity\Parcel $parcels)
    {
        $this->parcels[] = $parcels;

        return $this;
    }

    /**
     * Remove parcels
     *
     * @param \Regulzen\CoreBundle\Entity\Parcel $parcels
     */
    public function removeParcel(\Regulzen\CoreBundle\Entity\Parcel $parcels)
    {
        $this->parcels->removeElement($parcels);
    }

    /**
     * Get parcels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParcels()
    {
        return $this->parcels;
    }
}