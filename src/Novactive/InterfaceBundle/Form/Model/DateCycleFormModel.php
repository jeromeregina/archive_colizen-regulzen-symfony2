<?php
/**
 * Created by PhpStorm.
 * User: fnaccache
 * Date: 23/06/14
 * Time: 14:43
 */

namespace Novactive\InterfaceBundle\Form\Model;


class DateCycleFormModel
{
    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var \Novactive\AdminBundle\Entity\Cycle
     */
    private $cycle;

    public function __construct()
    {
        $this->date = new \DateTime('now');
    }

    /**
     * @param \Novactive\AdminBundle\Entity\Cycle $cycle
     */
    public function setCycle($cycle)
    {
        $this->cycle = $cycle;
    }

    /**
     * @return \Novactive\AdminBundle\Entity\Cycle
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
