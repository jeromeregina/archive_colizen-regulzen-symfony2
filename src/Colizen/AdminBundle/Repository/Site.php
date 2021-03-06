<?php

namespace Colizen\AdminBundle\Repository;

use Colizen\AdminBundle\Entity\Cycle as EntityCycle;
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
     * Nombre d'expéditions par site
     *
     * @param \DatTime $date
     * @param \Colizen\AdminBundle\Entity\Cycle    $cycle
     *
     * @return array
     */
    public function getNombreExpeditionsBySite (\DateTime $date, EntityCycle $cycle)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT s AS site, COUNT(sh.id) AS nombreExpeditions
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


    /**
     * Nombre de colis avec les statuts COEC (arrivé au centre) ou EDIR (étiqueté)
     *
     * @param \DatTime $date
     * @param \Colizen\AdminBundle\Entity\Cycle     $cycle
     *
     * @return array
     */
    public function countColisCoecEdirBySite(\DateTime $date, EntityCycle $cycle)
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT s AS site, COUNT(p.id) AS countColisCoecEdir
                                   FROM ColizenAdminBundle:Site s
                                     LEFT JOIN s.tours t
                                     LEFT JOIN t.theoricalSlots sl
                                     LEFT JOIN sl.shipment sh
                                     LEFT JOIN sh.parcels p
                                     LEFT JOIN ColizenAdminBundle:Status st WITH p.status = st.shortname
                                   WHERE t.date = :date
                                     AND sl.theoricalHour > :cycleStartHour
                                     AND sl.theoricalHour < :cycleEndHour
                                     AND (st.shortname = :coecStatus OR st.shortname = :edirStatus)
                                   GROUP BY s.id')
                    ->setParameter('date', $date)
                    ->setParameter('cycleStartHour', $cycle->getStart())
                    ->setParameter('cycleEndHour',   $cycle->getEnd())
                    ->setParameter('coecStatus', 'COEC')
                    ->setParameter('edirStatus', 'EDIR')
                    ->getResult();
    }

    /**
     * Nombre de colis avec les statuts TOUR
     *
     * @param \DatTime $date
     * @param \Colizen\AdminBundle\Entity\Cycle     $cycle
     *
     * @return array
     */
    public function countColisTourBySite(\DateTime $date, EntityCycle $cycle)
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT s AS site, IFNULL(COUNT(p.id), 0) AS countColisTour
                                   FROM ColizenAdminBundle:Site s
                                     LEFT JOIN s.tours t
                                     LEFT JOIN t.theoricalSlots sl
                                     LEFT JOIN sl.shipment sh
                                     LEFT JOIN sh.parcels p
                                     LEFT JOIN ColizenAdminBundle:Status st WITH p.status = st.shortname
                                   WHERE t.date = :date
                                     AND sl.theoricalHour > :cycleStartHour
                                     AND sl.theoricalHour < :cycleEndHour
                                     AND st.shortname = :tourStatus
                                   GROUP BY s.id')
                    ->setParameter('date', $date)
                    ->setParameter('cycleStartHour', $cycle->getStart())
                    ->setParameter('cycleEndHour',   $cycle->getEnd())
                    ->setParameter('tourStatus', 'TOUR')
                    ->getResult();
    }

    /**
     * Nombre de colis avec les statuts CTRL
     *
     * @param \DatTime $date
     * @param \Colizen\AdminBundle\Entity\Cycle     $cycle
     *
     * @return array
     */
    public function countColisCtrlBySite(\DateTime $date, EntityCycle $cycle)
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT s AS site, IFNULL(COUNT(p.id), 0) AS countColisCtrl
                                   FROM ColizenAdminBundle:Site s
                                     LEFT JOIN s.tours t
                                     LEFT JOIN t.theoricalSlots sl
                                     LEFT JOIN sl.shipment sh
                                     LEFT JOIN sh.parcels p
                                     LEFT JOIN ColizenAdminBundle:Status st WITH p.status = st.shortname
                                   WHERE t.date = :date
                                     AND sl.theoricalHour > :cycleStartHour
                                     AND sl.theoricalHour < :cycleEndHour
                                     AND st.shortname = :ctrlStatus
                                   GROUP BY s.id')
                    ->setParameter('date', $date)
                    ->setParameter('cycleStartHour', $cycle->getStart())
                    ->setParameter('cycleEndHour',   $cycle->getEnd())
                    ->setParameter('ctrlStatus', 'CTRL')
                    ->getResult();
    }

    /**
     * Nombre de tous les colis
     *
     * @param \DateTime $date
     * @param \Colizen\AdminBundle\Entity\Cycle      $cycle
     *
     * @return array
     */
    public function countColisBySite(\DateTime $date, EntityCycle $cycle)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT s AS site, COUNT(p.id) AS countColis
                                   FROM ColizenAdminBundle:Site s
                                     LEFT JOIN s.tours t
                                     LEFT JOIN t.theoricalSlots sl
                                     LEFT JOIN sl.shipment sh
                                     LEFT JOIN sh.parcels p
                                   WHERE t.date = :date
                                     AND sl.theoricalHour > :cycleStartHour
                                     AND sl.theoricalHour < :cycleEndHour
                                   GROUP BY s.id')
            ->setParameter('date', $date)
            ->setParameter('cycleStartHour', $cycle->getStart())
            ->setParameter('cycleEndHour',   $cycle->getEnd())
            ->getResult();
    }


    /**
     * Nombre de colis avec les statuts REMI ou NLIV (colis présentés au client)
     *
     * @param \DatTime $date
     * @param \Colizen\AdminBundle\Entity\Cycle     $cycle
     *
     * @return array
     */
    public function countColisRemiNlivBySite(\DateTime $date, EntityCycle $cycle)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT s AS site, IFNULL(COUNT(p.id), 0) AS countColisRemiNliv
                                   FROM ColizenAdminBundle:Site s
                                     LEFT JOIN s.tours t
                                     LEFT JOIN t.theoricalSlots sl
                                     LEFT JOIN sl.shipment sh
                                     LEFT JOIN sh.parcels p
                                     LEFT JOIN ColizenAdminBundle:Status st WITH p.status = st.shortname
                                   WHERE t.date = :date
                                     AND sl.theoricalHour > :cycleStartHour
                                     AND sl.theoricalHour < :cycleEndHour
                                     AND (st.shortname = :remiStatus OR st.shortname = :nlivStatus)
                                   GROUP BY s.id')
            ->setParameter('date', $date)
            ->setParameter('cycleStartHour', $cycle->getStart())
            ->setParameter('cycleEndHour',   $cycle->getEnd())
            ->setParameter('remiStatus', 'REMI')
            ->setParameter('nlivStatus', 'NLIV')
            ->getResult();
    }


    /**
     * Nombre de colis avec les statuts NLIV ou CNML (colis en échec)
     *
     * @param \DatTime $date
     * @param \Colizen\AdminBundle\Entity\Cycle     $cycle
     *
     * @return array
     */
    public function countColisNlivCnmlBySite(\DateTime $date, EntityCycle $cycle)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT s AS site, IFNULL(COUNT(p.id), 0) AS countColisNlivCnml
                                   FROM ColizenAdminBundle:Site s
                                     LEFT JOIN s.tours t
                                     LEFT JOIN t.theoricalSlots sl
                                     LEFT JOIN sl.shipment sh
                                     LEFT JOIN sh.parcels p
                                     LEFT JOIN ColizenAdminBundle:Status st WITH p.status = st.shortname
                                   WHERE t.date = :date
                                     AND sl.theoricalHour > :cycleStartHour
                                     AND sl.theoricalHour < :cycleEndHour
                                     AND (st.shortname = :nlivStatus OR st.shortname = :cnmlStatus)
                                   GROUP BY s.id')
            ->setParameter('date', $date)
            ->setParameter('cycleStartHour', $cycle->getStart())
            ->setParameter('cycleEndHour',   $cycle->getEnd())
            ->setParameter('nlivStatus', 'NLIV')
            ->setParameter('cnmlStatus', 'CNML')
            ->getResult();
    }

}
