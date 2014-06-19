<?php

namespace Novactive\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="number", type="integer", nullable=false)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_excluded", type="boolean", nullable=false, options={"default"=true})
     */
    private $isExcluded = true;



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
}
