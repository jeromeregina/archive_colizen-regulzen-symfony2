<?php

namespace Regulzen\RegulationBundle\Service;

use Regulzen\CoreBundle\Entity\Cycle;
use Regulzen\CoreBundle\Entity\Site;

interface TableauNationalInterface
{
    public function getTableauNational(\DateTime $date, Cycle $cycle);

    public function getTableauTournees(\DateTime $date, Cycle $cycle, Site $site);
}
