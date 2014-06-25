<?php

namespace Novactive\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Novactive\AdminBundle\Entity\Site;
use Gedmo\Mapping\Annotation as Gedmo;
use Novactive\AdminBundle\Entity\DeliveryAddress;
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
     * @ORM\Column(name="SHPMNT_cargopass", type="string", length=16, nullable=false)
     */
    private $cargopass;

    /**
     * @var string
     *
     * @ORM\Column(name="SHPMNT_shipper_id", type="string", length=8, nullable=false)
     */
    private $shipperId;

     /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="DeliveryAddress", cascade={"persist"}, inversedBy="shipment")
     * @ORM\JoinColumn(name="DLVRADDR_id", referencedColumnName="DLVRADDR_id", onDelete="SET NULL")
     */
    private $deliveryAddress;

    /**
     * @var integer
     *
     * @ORM\Column(name="SHPMNT_parcel_quantity", type="integer", nullable=false)
     */
    private $parcelQuantity;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="SHPMNT_delivery_date", type="date", nullable=true)
     */
    private $deliveryDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="SHPMNT_delivery_slot_start", type="time", nullable=true)
     */
    private $deliverySlotStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="SHPMNT_delivery_slot_end", type="time", nullable=true)
     */
    private $deliverySlotEnd;

    /**
     * @var integer
     *
     * @ORM\Column(name="SHPMNT_service_id", type="integer", nullable=true)
     */
    private $serviceId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="SHPMNT_creation_date", type="datetime", nullable=false)
     */
    private $creationDate;
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
     * @param string $cargopassEvent
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
     * Get cargopass format 12312323456789
     *
     * @return string 
     */
    public function getCargopassFormatted()
    {
        $pattern = '/(\d{3})-(\d{3})-(\d)(\d{8}) (\d{3})/';
        $replacement = '$1$3$4';
        return preg_replace($pattern, $replacement,$this->cargopass);
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

    /**
     * Set deliveryAddress
     *
     * @param \Novactive\AdminBundle\Entity\DeliveryAddress $deliveryAddress
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
     * @return \Novactive\AdminBundle\Entity\DeliveryAddress 
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * Set weight
     *
     * @param string $weight
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
}
