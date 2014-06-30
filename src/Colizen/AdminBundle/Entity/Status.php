<?php

namespace Colizen\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Status
 *
 * @ORM\Table(name="TBL_status")
 * @ORM\Entity()
 */
class Status {
    /**
     * @var integer
     *
     * @ORM\Column(name="STATUS_code", type="integer", nullable=false)
     * @ORM\Id
     */
    protected $code;
    
    /**
     * @var string
     *
     * @ORM\Column(name="STATUS_shortname", type="string", length=4, nullable=false)
     */
    protected $shortname;
    
    /**
     * @var string
     *
     * @ORM\Column(name="STATUS_description", type="string", length=255, nullable=false)
     */
    protected $description;
    /**
     *
     * @var boolean
     *  
     * @ORM\Column(name="STATUS_is_excluded", type="boolean", nullable=false, options={"default"=true})
     */
    protected $isExcluded;
   /**
    * @var \DateTime $created
    *
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(name="EVENT_created", type="datetime")
    */
   private $created;
   
    /**
    * @var \DateTime $created
    *
    * @Gedmo\Timestampable(on="update")
    * @ORM\Column(name="EVENT_updated", type="datetime")
    */
   private $updated;
    /**
     * Set code
     *
     * @param integer $code
     * @return Status
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
     * Set shortname
     *
     * @param string $shortname
     * @return Status
     */
    public function setShortname($shortname)
    {
        $this->shortname = $shortname;

        return $this;
    }

    /**
     * Get shortname
     *
     * @return string 
     */
    public function getShortname()
    {
        return $this->shortname;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Status
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set isExcluded
     *
     * @param boolean $isExcluded
     * @return Status
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
}
