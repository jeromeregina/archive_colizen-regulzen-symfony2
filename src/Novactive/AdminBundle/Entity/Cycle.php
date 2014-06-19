<?php

namespace Novactive\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

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
     * @var integer
     *
     * @ORM\Column(name="CYCLE_number", type="integer", nullable=false)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="CYCLE_name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="CYCLE_is_excluded", type="boolean", nullable=false, options={"default"=true})
     */
    private $isExcluded = true;

    /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(name="CYCLE_created", type="datetime")
    */
   private $created;
   
    /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="update")
    * @ORM\Column(name="CYCLE_updated", type="datetime")
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
     * Set number
     *
     * @param integer $number
     * @return Cycle
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
     * Set isExcluded
     *
     * @param boolean $isExcluded
     * @return Cycle
     */
    public function setIsExcluded($isExcluded)
    {
        $this->isExcluded = (boolean) $isExcluded;

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
}
