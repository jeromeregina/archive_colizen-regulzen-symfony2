<?php

namespace Novactive\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Novactive\AdminBundle\Entity\TourCode;
/**
 * TblCycle
 *
 * @ORM\Table(name="TBL_cycle")
 * @ORM\Entity(repositoryClass="Novactive\AdminBundle\Repository\Cycle")
 */
class Cycle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CYCLE_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="CYCLE_name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="CYCLE_tour_code_format", type="string", length=45, nullable=true)
     */
    private $tourCodeFormat;

    /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(name="CYCLE_created", type="datetime")
    */
   private $created;
   
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CYCLE_start", type="time", nullable=false)
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CYCLE_end", type="time", nullable=false)
     */
    private $end;
    /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="update")
    * @ORM\Column(name="CYCLE_updated", type="datetime")
    */
   private $updated;
   
    /**
     * @ORM\OneToMany(targetEntity="TourCode", mappedBy="cycle")
     */
    private $tourCodes;
    
    public function __construct() {
        $this->tourCodes = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Cycle
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
     * Set start
     *
     * @param \DateTime $start
     * @return Cycle
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     * @return Cycle
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime 
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set tourCodeFormat
     *
     * @param string $tourCodeFormat
     * @return Cycle
     */
    public function setTourCodeFormat($tourCodeFormat)
    {
        $this->tourCodeFormat = $tourCodeFormat;

        return $this;
    }

    /**
     * Get tourCodeFormat
     *
     * @return string 
     */
    public function getTourCodeFormat()
    {
        return $this->tourCodeFormat;
    }

    /**
     * Add tourCodes
     *
     * @param \Novactive\AdminBundle\Entity\TourCode $tourCodes
     * @return Cycle
     */
    public function addTourCode(TourCode $tourCodes)
    {
        $this->tourCodes[] = $tourCodes;

        return $this;
    }

    /**
     * Remove tourCodes
     *
     * @param \Novactive\AdminBundle\Entity\TourCode $tourCodes
     */
    public function removeTourCode(TourCode $tourCodes)
    {
        $this->tourCodes->removeElement($tourCodes);
    }

    /**
     * Get tourCodes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTourCodes()
    {
        return $this->tourCodes;
    }
}
