<?php

namespace Colizen\InterfaceBundle\Service;

use Colizen\AdminBundle\Entity\Cycle;

interface TableauNationalInterface
{
    public function getTableauNational(\DateTime $date, Cycle $cycle);
}
