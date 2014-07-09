<?php

namespace Regulzen\RegulationBundle\Form\Model;

class DateCycleFormModel
{
    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var \Regulzen\CoreBundle\Entity\Cycle
     */
    private $cycle;

    public function __construct()
    {
        $this->date = new \DateTime('now');
    }

    /**
     * @param \Regulzen\CoreBundle\Entity\Cycle $cycle
     */
    public function setCycle($cycle)
    {
        $this->cycle = $cycle;
    }

    /**
     * @return \Regulzen\CoreBundle\Entity\Cycle
     */
    public function getCycle()
    {
        return $this->cycle;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
