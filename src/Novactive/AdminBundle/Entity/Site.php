<?php

namespace Novactive\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * TblSite
 *
 * @ORM\Table(name="TBL_site")
 * @ORM\Entity(repositoryClass="Novactive\AdminBundle\Repository\Site")
 */
class Site
{
    /**
     * @var integer
     *
     * @ORM\Column(name="SITE_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="SITE_name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="SITE_code_czn", type="string", length=3, nullable=false)
     */
    private $codeColizen;
    /**
     * @var string
     *
     * @ORM\Column(name="SITE_code_imtech", type="string", length=3, nullable=false)
     */
    private $codeImtech;
    
    /**
     * @var string
     *
     * @ORM\Column(name="SITE_number", type="string", length=3, nullable=false)
     */
    private $number;

    /**
     * @var boolean
     *
     * @ORM\Column(name="SITE_is_active", type="boolean", nullable=false, options={"default" = true})
     */
    private $isActive = true;

    /**
     * @var string
     *
     * @ORM\Column(name="SITE_longitude", type="decimal", precision=9, scale=6, nullable=false, options={"default" = 0})
     */
    private $longitude = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="SITE_latitude", type="decimal", precision=8, scale=6, nullable=false, options={"default" = 0})
     */
    private $latitude = 0;

    /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(name="SITE_created", type="datetime")
    */
   private $created;
   
    /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="update")
    * @ORM\Column(name="SITE_updated", type="datetime")
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
     * Set name
     *
     * @param string $name
     * @return Site
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
     * Set isActive
     *
     * @param boolean $isActive
     * @return Site
     */
    public function setIsActive($isActive)
    {
        $this->isActive = (boolean) $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return Site
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
     * @return Site
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
     * Set number
     *
     * @param string $number
     * @return Site
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set codeColizen
     *
     * @param string $codeColizen
     * @return Site
     */
    public function setCodeColizen($codeColizen)
    {
        $this->codeColizen = $codeColizen;

        return $this;
    }

    /**
     * Get codeColizen
     *
     * @return string 
     */
    public function getCodeColizen()
    {
        return $this->codeColizen;
    }

    /**
     * Set codeImtech
     *
     * @param string $codeImtech
     * @return Site
     */
    public function setCodeImtech($codeImtech)
    {
        $this->codeImtech = $codeImtech;

        return $this;
    }

    /**
     * Get codeImtech
     *
     * @return string 
     */
    public function getCodeImtech()
    {
        return $this->codeImtech;
    }
}
