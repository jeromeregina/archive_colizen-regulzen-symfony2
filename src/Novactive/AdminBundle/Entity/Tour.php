<?php

namespace Novactive\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Novactive\AdminBundle\Entity\Cycle;

/**
 * TblCycle
 *
 * @ORM\Table(name="TBL_tour")
 * @ORM\Entity(repositoryClass="Novactive\AdminBundle\Repository\Tour")
 */
class Tour {
    /**
     * @var integer
     *
     * @ORM\Column(name="TOUR_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
     /**
     * @var integer
     *
     * @ORM\Column(name="TOUR_number", type="integer", nullable=false)
     */
    private $number;
   /**
     * @var string
     *
     * @ORM\Column(name="TOUR_name", type="string", length=45, nullable=false)
     */
    private $name;
     /**
     * @var boolean
     *
     * @ORM\Column(name="TOUR_is_excluded", type="boolean", nullable=false, options={"default"=true})
     */
    private $isExcluded = true;
   /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(name="TOUR_created", type="datetime")
    */
   private $created;
   
    /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="update")
    * @ORM\Column(name="TOUR_updated", type="datetime")
    */
   private $updated;
     /**
     * @var Cycle
     *
     * @ORM\ManyToOne(targetEntity="Cycle", inversedBy="tours")
     * @ORM\JoinColumn(name="CYCLE_id", referencedColumnName="CYCLE_id", nullable=false)
     */
    private $cycle;

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
     * Set number
     *
     * @param integer $number
     * @return Tour
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Tour
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
}
