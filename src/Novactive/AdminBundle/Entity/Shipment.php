<?php

namespace Novactive\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Novactive\AdminBundle\Entity\Site;
/**
 * TblShipment
 *
 * @ORM\Table(name="TBL_shipment", indexes={@ORM\Index(name="fk_shipment_site1_idx", columns={"SITE_id"})})
 * @ORM\Entity(repositoryClass="Novactive\AdminBundle\Repository\Shipment")
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
     * @ORM\Column(name="cargopass_event", type="string", length=12, nullable=false)
     */
    private $cargopassEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="cargopass_parcel", type="string", length=12, nullable=false)
     */
    private $cargopassParcel;

    /**
     * @var string
     *
     * @ORM\Column(name="shipper_id", type="string", length=8, nullable=false)
     */
    private $shipperId;

    /**
     * @var string
     *
     * @ORM\Column(name="delivery_address", type="text", nullable=false)
     */
    private $deliveryAddress;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcel_quantity", type="integer", nullable=false)
     */
    private $parcelQuantity;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="delivery_date", type="date", nullable=true)
     */
    private $deliveryDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="delivery_slot_start", type="time", nullable=true)
     */
    private $deliverySlotStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="delivery_slot_end", type="time", nullable=true)
     */
    private $deliverySlotEnd;

    /**
     * @var integer
     *
     * @ORM\Column(name="service_id", type="integer", nullable=true)
     */
    private $serviceId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime", nullable=false)
     */
    private $creationDate;

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
     * @return Shipment
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
     * @return Shipment
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
     * Set shipperId
     *
     * @param string $shipperId
     * @return Shipment
     */
    public function setShipperId($shipperId)
    {
        $this->shipperId = $shipperId;

        return $this;
    }

    /**
     * Get shipperId
     *
     * @return string 
     */
    public function getShipperId()
    {
        return $this->shipperId;
    }

    /**
     * Set deliveryAddress
     *
     * @param string $deliveryAddress
     * @return Shipment
     */
    public function setDeliveryAddress($deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    /**
     * Get deliveryAddress
     *
     * @return string 
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * Set parcelQuantity
     *
     * @param integer $parcelQuantity
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
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return Shipment
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime 
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set site
     *
     * @param \Novactive\AdminBundle\Entity\Site $site
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
     * @return \Novactive\AdminBundle\Entity\Site 
     */
    public function getSite()
    {
        return $this->site;
    }
}
