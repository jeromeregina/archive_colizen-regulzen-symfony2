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
     * @ORM\Column(name="PRCL_cargopass_parcel", type="string", length=8, nullable=false)
     */
    private $cargopassParcel;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRCL_nb_presentations", type="integer", nullable=false, options={"default" = 1})
     */
    private $nbPresentations = 1;

    /**
     * @var Shipment
     *
     * @ORM\ManyToOne(targetEntity="Shipment")
     * @ORM\JoinColumn(name="SHPMNT_id", referencedColumnName="SHPMNT_id", nullable=false)
     */
    private $shipment;
    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="parcel")
     */
    private  $events;

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
     * Set cargopassParcel
     *
     * @param string $cargopassParcel
     *
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
}
