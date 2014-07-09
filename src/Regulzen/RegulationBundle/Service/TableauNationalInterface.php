<?php

namespace Regulzen\RegulationBundle\Service;

use Regulzen\CoreBundle\Entity\Cycle;

interface TableauNationalInterface
{
    public function getTableauNational(\DateTime $date, Cycle $cycle);
}
