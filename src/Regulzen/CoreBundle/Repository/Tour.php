<?php

namespace Regulzen\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Regulzen\CoreBundle\Entity\Cycle;
use Regulzen\CoreBundle\Entity\Site as SiteEntity;
use Regulzen\CoreBundle\Entity\Tour as Entity;

class Tour extends EntityRepository
{
    /**
     * returns existing Tour or new one by if missing
     * @param  string                           $code
     * @param  \DateTime                        $date
     * @param \Regulzen\CoreBundle\Entity\Site
     * @return \Regulzen\CoreBundle\Entity\Tour
     */
    public function resolveByTourCodeDateAndSite($code,\DateTime $date,SiteEntity $site)
    {
           $tourCode =  $this->_em->getRepository('RegulzenCoreBundle:TourCode')->resolveByCode($code);

           $existing=$this->findOneBy(array('tourCode'=>$tourCode,'date'=>$date,'site'=>$site));

           if ($existing instanceof Entity)
               return $existing;

            $new = new Entity();
            $new->setSite($site)
                 ->setTourCode($tourCode)
                 ->setDate($date);

           return $new;

        }

    public function getSiteTours(SiteEntity $site, \DateTime $date, Cycle $cycle)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT t
                           FROM RegulzenCoreBundle:Tour t
                             JOIN t.site s
                             JOIN t.theoricalSlots sl
                           WHERE t.date = :date
                             AND sl.theoricalHour > :cycleStartHour
                             AND sl.theoricalHour < :cycleEndHour
                             AND s.id = :siteId
                           ')
            ->setParameter('date', $date)
            ->setParameter('cycleStartHour', $cycle->getStart())
            ->setParameter('cycleEndHour',   $cycle->getEnd())
            ->setParameter('siteId',   $site->getId())
            ->getResult();
    }
}
