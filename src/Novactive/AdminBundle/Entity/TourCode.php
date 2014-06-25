<?php

namespace Novactive\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Novactive\AdminBundle\Entity\Cycle;

/**
 * TblCycle
 *
 * @ORM\Table(name="TBL_tour_code")
 * @ORM\Entity(repositoryClass="Novactive\AdminBundle\Repository\TourCode")
 */
class TourCode {
    /**
     * @var integer
     *
     * @ORM\Column(name="TOURCODE_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
     /**
     * @var integer
     *
     * @ORM\Column(name="TOURCODE_code", type="integer", nullable=false)
     */
    protected $code;
    
     /**
     * @var boolean
     *
     * @ORM\Column(name="TOURCODE_is_excluded", type="boolean", nullable=false, options={"default"=true})
     */
    protected $isExcluded = true;
    /**
     * @ORM\OneToMany(targetEntity="Tour", mappedBy="tourCode")
     */
    private $tours;
    
   /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(name="TOURCODE_created", type="datetime")
    */
   protected $created;
   
    /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="update")
    * @ORM\Column(name="TOURCODE_updated", type="datetime")
    */
   protected $updated;
     /**
     * @var Cycle
     *
     * @ORM\ManyToOne(targetEntity="Cycle", inversedBy="tourCodes")
     * @ORM\JoinColumn(name="CYCLE_id", referencedColumnName="CYCLE_id", nullable=true)
     */
    protected $cycle;
    
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
     * Set isExcluded
     *
     * @param boolean $isExcluded
     * @return Tour
     */
    public function setIsExcluded($isExcluded)
    {
        $this->isExcluded = $isExcluded;

        return $this;
    }

    /**
     * Get isExcluded
     *
     * @return boolean 
     */
    public function getIsExcluded()
    {
        return $this->isExcluded;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Tour
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
     * @return Tour
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
     * Set cycle
     *
     * @param \Novactive\AdminBundle\Entity\Cycle $cycle
     * @return Tour
     */
    public function setCycle(Cycle $cycle)
    {
        $this->cycle = $cycle;

        return $this;
    }

    /**
     * Get cycle
     *
     * @return \Novactive\AdminBundle\Entity\Cycle 
     */
    public function getCycle()
    {
        return $this->cycle;
    }

    /**
     * Set code
     *
     * @param integer $code
     * @return TourCode
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Add tours
     *
     * @param \Novactive\AdminBundle\Entity\Tour $tours
     * @return TourCode
     */
    public function addTour(\Novactive\AdminBundle\Entity\Tour $tours)
    {
        $this->tours[] = $tours;

        return $this;
    }

    /**
     * Remove tours
     *
     * @param \Novactive\AdminBundle\Entity\Tour $tours
     */
    public function removeTour(\Novactive\AdminBundle\Entity\Tour $tours)
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
}
