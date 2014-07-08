<?php

namespace Colizen\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

use Colizen\AdminBundle\Entity\Shipment as Entity;

class Shipment extends EntityRepository
{
    /**
     * returns existing Shipment or new one by if missing
     *
     * @param  string                               $cargopass of format <i>xxx-yyy-123456789 zzz</i>
     * @return \Colizen\AdminBundle\Entity\Shipment
     */
    public function resolveByCargopass($cargopass)
    {
           $shipment=$this->findOneBy(array('cargopass'=>$cargopass));

           return ($shipment instanceof Entity)?$shipment:new Entity();

        }
    /**
     * returns existing Shipment by "15 numbers format cargopass"
     *
     * @param  string                               $cargopass of format <i>xxxyyy123456789</i>
     * @return \Colizen\AdminBundle\Entity\Shipment
     */
    public function findOneByFifteenIntegersFormatCargopass($cargopass)
    {
        $qb=$this->createQueryBuilder('s');

        $pattern = '/(\d{3})(\d{3})(\d{9})/';
        $replacement = '$1-$2-$3____';
        $searchPattern= preg_replace($pattern, $replacement, $cargopass);

        $qb->where($qb->expr()->like('s.cargopass', ':searchPattern'));

        $qb->setParameter('searchPattern', $searchPattern);

        return $qb->getQuery()->getSingleResult();
    }
}
