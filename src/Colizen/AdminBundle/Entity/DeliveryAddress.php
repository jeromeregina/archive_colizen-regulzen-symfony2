<?php

namespace Colizen\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Colizen\AdminBundle\Entity\Shipment;

/**
 * TblCycle
 *
 * @ORM\Table(name="TBL_delivery_address")
 * @ORM\Entity(repositoryClass="Colizen\AdminBundle\Repository\DeliveryAddress")
 */
class DeliveryAddress {
    /**
     * @var integer
     *
     * @ORM\Column(name="DLVRADDR_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    /**
     * @var string
     *
     * @ORM\Column(name="DLVRADDR_country", type="string", length=1, nullable=false)
     */
    protected $country;
     /**
     * @var string
     *
     * @ORM\Column(name="DLVRADDR_zipcode", type="string", length=10, nullable=false)
     */
    protected $zipcode;
     /**
     * @var string
     *
     * @ORM\Column(name="DLVRADDR_zipcode_extended", type="string", length=30, nullable=true)
     */
    protected $zipcodeExtended;
     /**
     * @var string
     *
     * @ORM\Column(name="DLVRADDR_city", type="string", length=58, nullable=false)
     */
    protected $city;
     /**
     * @var string
     *
     * @ORM\Column(name="DLVRADDR_address", type="text", nullable=false)
     */
    protected $address;
     /**
     * @var string
     *
     * @ORM\Column(name="DLVRADDR_name", type="string", length=255, nullable=false)
     */
    protected $name;
     /**
     * @var string
     *
     * @ORM\Column(name="DLVRADDR_telephone", type="string", length=12, nullable=true)
     */
    protected $telephone;
     /**
     * @var string
     *
     * @ORM\Column(name="DLVRADDR_email", type="string", length=255, nullable=true)
     */
    protected $email;
  /**
     * @var string
     *
     * @ORM\Column(name="DLVRADDR_longitude", type="decimal", precision=9, scale=6, nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="DLVRADDR_latitude", type="decimal", precision=8, scale=6, nullable=true)
     */
    private $latitude;
     /**
     * @var string
     *
     * @ORM\Column(name="DLVRADDR_additional_infos", type="string", length=255, nullable=true)
     */
    protected $additionalInformations;
     /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="Shipment", cascade={"persist"}, mappedBy="deliveryAddress")
     * @ORM\JoinColumn(name="SHPMNT_id", referencedColumnName="SHPMNT_id", onDelete="CASCADE")
     */
    protected $shipment;
    
   /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(name="DLVRADDR_created", type="datetime")
    */
   private $created;
   
    /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="update")
    * @ORM\Column(name="DLVRADDR_updated", type="datetime")
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
     * Set country
     *
     * @param string $country
     * @return DeliveryAddress
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     * @return DeliveryAddress
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string 
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return DeliveryAddress
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return DeliveryAddress
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return DeliveryAddress
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return DeliveryAddress
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return DeliveryAddress
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return DeliveryAddress
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return DeliveryAddress
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set additionalInformations
     *
     * @param string $additionalInformations
     * @return DeliveryAddress
     */
    public function setAdditionalInformations($additionalInformations)
    {
        $this->additionalInformations = $additionalInformations;

        return $this;
    }

    /**
     * Get additionalInformations
     *
     * @return string 
     */
    public function getAdditionalInformations()
    {
        return $this->additionalInformations;
    }

    /**
     * Set shipment
     *
     * @param \Colizen\AdminBundle\Entity\Shipment $shipment
     * @return DeliveryAddress
     */
    public function setShipment(Shipment $shipment)
    {
        $shipment->setDeliveryAddress($this);
        
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
     * Set zipcodeExtended
     *
     * @param string $zipcodeExtended
     * @return DeliveryAddress
     */
    public function setZipcodeExtended($zipcodeExtended)
    {
        $this->zipcodeExtended = $zipcodeExtended;

        return $this;
    }

    /**
     * Get zipcodeExtended
     *
     * @return string 
     */
    public function getZipcodeExtended()
    {
        return $this->zipcodeExtended;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return DeliveryAddress
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
     * @return DeliveryAddress
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
