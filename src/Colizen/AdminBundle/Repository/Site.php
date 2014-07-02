<?php

namespace Colizen\AdminBundle\Repository;

use Colizen\AdminBundle\Entity\Cycle;
use Doctrine\ORM\EntityRepository;

class Site extends EntityRepository
{
    public function findOneByAnyCode($code){
        $qb=$this->createQueryBuilder('s');
        
        $qb->where('s.codeColizen = :code')
           ->orWhere('s.codeImtech = :code')
           ->orWhere('s.number = :code')
           ->setParameter('code', $code);
        
        return $qb->getQuery()->getSingleResult();
           
    }

    /**
     * @param \DatTime $date
     * @param Cycle    $cycle
     *
     * @return array
     */
    public function getNombreExpeditionsBySite(\DateTime $date, Cycle $cycle)
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT s AS site, SUM(sh.parcelQuantity) AS nombreExpeditions
                                   FROM ColizenAdminBundle:Site s
                                     LEFT JOIN s.tours t
                                     LEFT JOIN t.theoricalSlots sl
                                     LEFT JOIN sl.shipment sh
                                   WHERE t.date = :date
                                     AND sl.theoricalHour > :cycleStartHour
                                     AND sl.theoricalHour < :cycleEndHour
                                   GROUP BY s.id')
                    ->setParameter('date', $date)
                    ->setParameter('cycleStartHour', $cycle->getStart())
                    ->setParameter('cycleEndHour',   $cycle->getEnd())
                    ->getResult();
    }
}
