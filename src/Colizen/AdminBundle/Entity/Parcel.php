<?php

namespace Colizen\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * TblParcel
 *
 * @ORM\Table(name="TBL_parcel", indexes={@ORM\Index(name="fk_parcel_shipment_idx", columns={"SHPMNT_id"})})
 * @ORM\Entity(repositoryClass="Colizen\AdminBundle\Repository\Parcel")
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
     * @ORM\Column(name="PRCL_cargopass", type="string", length=8, nullable=false)
     */
    private $cargopass;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRCL_nb_presentations", type="integer", nullable=false, options={"default" = 1})
     */
    private $nbPresentations = 1;
    
    /**
     * @var status
     *
     * @ORM\Column(name="PRCL_status", type="integer", nullable=false, options={"default" = 1})
     */
    private $status = 1;

    /**
     * @var integer
     * 
     * Parcel's weight in grams
     * 
     * @ORM\Column(name="PRCL_weight", type="integer", nullable=false, options={"default" = 0})
     */
    private $weight = 0;
    /**
     * @var integer
     * 
     * Parcel's width in centimeters
     * 
     * @ORM\Column(name="PRCL_width", type="integer", nullable=false, options={"default" = 0})
     */
    private $width = 0;
    /**
     * @var integer
     * 
     * Parcel's depth in centimeters
     * 
     * @ORM\Column(name="PRCL_depth", type="integer", nullable=false, options={"default" = 0})
     */
    private $depth = 0;
    /**
     * @var integer
     * 
     * Parcel's height in centimeters
     * 
     * @ORM\Column(name="PRCL_height", type="integer", nullable=false, options={"default" = 0})
     */
    private $height = 0;
    
    /**
     * @var Shipment
     *
     * @ORM\ManyToOne(targetEntity="Shipment", inversedBy="parcels")
     * @ORM\JoinColumn(name="SHPMNT_id", referencedColumnName="SHPMNT_id", nullable=false)
     */
    private $shipment;

    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="parcel")
     */
    private  $events;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="PRCL_created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="PRCL_updated", type="datetime")
     */
    private $updated;

    public function __construct()
    {
        $this->events = new ArrayCollection();
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
     *
     * @return Parcel
     */
    public function setCargopass($cargopassParcel)
    {
        $this->cargopass = $cargopassParcel;

        return $this;
    }

    /**
     * Get cargopass
     *
     * @return string
     */
    public function getCargopass()
    {
        return $this->cargopass;
    }


    /**
     * Set nbPresentations
     *
     * @param integer $nbPresentations
     *
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
     * Set shpmnt
     *
     * @param \Colizen\AdminBundle\Entity\Shipment $shpmnt
     *
     * @return Parcel
     */
    public function setShipment(Shipment $shpmnt)
    {
        $this->shipment = $shpmnt;

        return $this;
    }

    /**
     * Get shpmnt
     *
     * @return \Colizen\AdminBundle\Entity\Shipment
     */
    public function getShipment()
    {
        return $this->shipment;
    }

    /**
     * Set customerAddress
     *
     * @param string $customerAddress
     *
     * @return Parcel
     */
    public function setCustomerAddress($customerAddress)
    {
        $this->customerAddress = $customerAddress;

        return $this;
    }

    /**
     * Get customerAddress
     *
     * @return string
     */
    public function getCustomerAddress()
    {
        return $this->customerAddress;
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
     * Add events
     *
     * @param \Colizen\AdminBundle\Entity\Event $events
     * @return Parcel
     */
    public function addEvent(\Colizen\AdminBundle\Entity\Event $events)
    {
        $this->events[] = $events;

        return $this;
    }

    /**
     * Remove events
     *
     * @param \Colizen\AdminBundle\Entity\Event $events
     */
    public function removeEvent(\Colizen\AdminBundle\Entity\Event $events)
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
     * Set status
     *
     * @param integer $status
     * @return Parcel
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     * @return Parcel
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set width
     *
     * @param integer $width
     * @return Parcel
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer 
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set depth
     *
     * @param integer $depth
     * @return Parcel
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;

        return $this;
    }

    /**
     * Get depth
     *
     * @return integer 
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * Set height
     *
     * @param integer $height
     * @return Parcel
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer 
     */
    public function getHeight()
    {
        return $this->height;
    }
}
