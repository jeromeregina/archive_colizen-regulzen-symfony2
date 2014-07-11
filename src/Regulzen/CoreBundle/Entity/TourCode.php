<?php

namespace Regulzen\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * TblCycle
 *
 * @ORM\Table(name="TBL_tour_code")
 * @ORM\Entity(repositoryClass="Regulzen\CoreBundle\Repository\TourCode")
 */
class TourCode
{
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
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Cycle", inversedBy="tourCodes", cascade={"persist"})
     * @ORM\JoinTable(name="JNT_tour_code_has_cycle",
     *      joinColumns={@ORM\JoinColumn(name="TOURCODE_id", referencedColumnName="TOURCODE_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="CYCLE_id", referencedColumnName="CYCLE_id")}
     *      )
     */
    protected $cycles;
    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="TOURCODE_created", type="datetime")
     */
    protected $created;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="TOURCODE_updated", type="datetime")
     */
    protected $updated;

    public function __construct()
    {
        $this->tours = new ArrayCollection();
        $this->cycles = new ArrayCollection();
    }


    public function __toString()
    {
        return ''.$this->code;
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
     *
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
     *
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
     *
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
     * Set code
     *
     * @param integer $code
     *
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
     * @param \Regulzen\CoreBundle\Entity\Tour $tours
     *
     * @return TourCode
     */
    public function addTour(\Regulzen\CoreBundle\Entity\Tour $tours)
    {
        $this->tours[] = $tours;

        return $this;
    }

    /**
     * Remove tours
     *
     * @param \Regulzen\CoreBundle\Entity\Tour $tours
     */
    public function removeTour(\Regulzen\CoreBundle\Entity\Tour $tours)
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
     * Add cycles
     *
     * @param  \Regulzen\CoreBundle\Entity\Cycle $cycles
     * @return TourCode
     */
    public function addCycle(\Regulzen\CoreBundle\Entity\Cycle $cycle)
    {
        $cycle->addTourCode($this);

        $this->cycles->add($cycle);

        return $this;
    }

    /**
     * Remove cycles
     *
     * @param \Regulzen\CoreBundle\Entity\Cycle $cycles
     */
    public function removeCycle(\Regulzen\CoreBundle\Entity\Cycle $cycles)
    {
        $this->cycles->removeElement($cycles);
    }

    /**
     * Get cycles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCycles()
    {
        return $this->cycles;
    }
}
