<?php

namespace Novactive\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Novactive\AdminBundle\Entity\Tour;
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
     * @ORM\OneToMany(targetEntity="Tour", mappedBy="cycle")
     */
    private $tours;
    
    public function __construct() {
        $this->tours = new ArrayCollection();
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
     * Add tours
     *
     * @param \Novactive\AdminBundle\Entity\Tour $tours
     * @return Cycle
     */
    public function addTour(Tour $tours)
    {
        $this->tours[] = $tours;

        return $this;
    }

    /**
     * Remove tours
     *
     * @param \Novactive\AdminBundle\Entity\Tour $tours
     */
    public function removeTour(Tour $tours)
    {
        $this->tours->removeElement($tours);
    }

    /**
     * Get tours
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTours()
    {
        return $this->tours;
    }
    /**
     * set tours
     *
     *  @param \Doctrine\Common\Collections\Collection  $tours
     * @return Cycle 
     */
    public function setTours($tours)
    {
        $this->tours = $tours;
        
        return $this;
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
}
