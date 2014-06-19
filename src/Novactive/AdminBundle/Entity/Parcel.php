<?php

namespace Novactive\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Novactive\AdminBundle\Entity\Shipment;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * TblParcel
 *
 * @ORM\Table(name="TBL_parcel", indexes={@ORM\Index(name="fk_parcel_shipment_idx", columns={"SHPMNT_id"})})
 * @ORM\Entity(repositoryClass="Novactive\AdminBundle\Repository\Parcel")
 */
class Parcel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="PRCL_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="PRCL_cargopass_parcel", type="string", length=8, nullable=false)
     */
    private $cargopassParcel;

    /**
     * @var boolean
     *
     * @ORM\Column(name="PRCL_premium", type="boolean", nullable=false, options={"default" = false})
     */
    private $premium = false;

    /**
     * @var string
     *
     * @ORM\Column(name="PRCL_shipper_id", type="string", length=8, nullable=false)
     */
    private $shipperId;

    /**
     * @var string
     *
     * @ORM\Column(name="PRCL_customer_name", type="string", length=255, nullable=true)
     */
    private $customerName;

    /**
     * @var string
     *
     * @ORM\Column(name="PRCL_customer_phone", type="string", length=12, nullable=true)
     */
    private $customerPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="PRCL_customer_email", type="string", length=255, nullable=true)
     */
    private $customerEmail;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRCL_shipper_status", type="integer", nullable=false, options={"default" = 0})
     */
    private $shipperStatus = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRCL_nb_presentations", type="integer", nullable=false, options={"default" = 1})
     */
    private $nbPresentations = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRCL_parcel_status", type="integer", nullable=false)
     */
    private $parcelStatus;

    /**
     * @var Shipment
     *
     * @ORM\ManyToOne(targetEntity="Shipment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="SHPMNT_id", referencedColumnName="SHPMNT_id", nullable=false)
     * })
     */
    private $shpmnt;

    /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(name="PRCL_created", type="datetime")
    */
   private $created;
   
    /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="update")
    * @ORM\Column(name="PRCL_updated", type="datetime")
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
     * Set cargopassParcel
     *
     * @param string $cargopassParcel
     * @return Parcel
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
     * Set premium
     *
     * @param boolean $premium
     * @return Parcel
     */
    public function setPremium($premium)
    {
        $this->premium = (boolean) $premium;

        return $this;
    }

    /**
     * Get premium
     *
     * @return boolean 
     */
    public function getPremium()
    {
        return $this->premium;
    }

    /**
     * Set shipperId
     *
     * @param string $shipperId
     * @return Parcel
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
     * Set customerName
     *
     * @param string $customerName
     * @return Parcel
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;

        return $this;
    }

    /**
     * Get customerName
     *
     * @return string 
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * Set customerPhone
     *
     * @param string $customerPhone
     * @return Parcel
     */
    public function setCustomerPhone($customerPhone)
    {
        $this->customerPhone = $customerPhone;

        return $this;
    }

    /**
     * Get customerPhone
     *
     * @return string 
     */
    public function getCustomerPhone()
    {
        return $this->customerPhone;
    }

    /**
     * Set customerEmail
     *
     * @param string $customerEmail
     * @return Parcel
     */
    public function setCustomerEmail($customerEmail)
    {
        $this->customerEmail = $customerEmail;

        return $this;
    }

    /**
     * Get customerEmail
     *
     * @return string 
     */
    public function getCustomerEmail()
    {
        return $this->customerEmail;
    }

    /**
     * Set shipperStatus
     *
     * @param integer $shipperStatus
     * @return Parcel
     */
    public function setShipperStatus($shipperStatus)
    {
        $this->shipperStatus = $shipperStatus;

        return $this;
    }

    /**
     * Get shipperStatus
     *
     * @return integer 
     */
    public function getShipperStatus()
    {
        return $this->shipperStatus;
    }

    /**
     * Set nbPresentations
     *
     * @param integer $nbPresentations
     * @return Parcel
     */
    public function setNbPresentations($nbPresentations)
    {
        $this->nbPresentations = $nbPresentations;

        return $this;
    }

    /**
     * Get nbPresentations
     *
     * @return integer 
     */
    public function getNbPresentations()
    {
        return $this->nbPresentations;
    }

    /**
     * Set parcelStatus
     *
     * @param integer $parcelStatus
     * @return Parcel
     */
    public function setParcelStatus($parcelStatus)
    {
        $this->parcelStatus = $parcelStatus;

        return $this;
    }

    /**
     * Get parcelStatus
     *
     * @return integer 
     */
    public function getParcelStatus()
    {
        return $this->parcelStatus;
    }

    /**
     * Set shpmnt
     *
     * @param \Novactive\AdminBundle\Entity\Shipment $shpmnt
     * @return Parcel
     */
    public function setShpmnt(Shipment $shpmnt)
    {
        $this->shpmnt = $shpmnt;

        return $this;
    }

    /**
     * Get shpmnt
     *
     * @return \Novactive\AdminBundle\Entity\Shipment 
     */
    public function getShpmnt()
    {
        return $this->shpmnt;
    }
}
