<?php

namespace Colizen\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * TblShipment
 *
 * @ORM\Table(name="TBL_possible_slot")})
 * @ORM\Entity(repositoryClass="Colizen\AdminBundle\Repository\PossibleSlot")
 */
class PossibleSlot {
   /**
     * @var integer
     *
     * @ORM\Column(name="PSLOT_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="PSLOT_start", type="time", nullable=true)
     */
    private $start;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="PSLOT_end", type="time", nullable=true)
     */
    private $end;
    
   /**
    * @var \DateTime $created
    *
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(name="PSLOT_created", type="datetime")
    */
    private $created;

    /**
    * @var \DateTime $created
    *
    * @Gedmo\Timestampable(on="update")
    * @ORM\Column(name="PSLOT_updated", type="datetime")
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
     * Set start
     *
     * @param \DateTime $start
     * @return PossibleSlot
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
     * @return PossibleSlot
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
     * Set created
     *
     * @param \DateTime $created
     * @return PossibleSlot
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
     * @return PossibleSlot
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
