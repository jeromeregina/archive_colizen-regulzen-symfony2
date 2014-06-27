<?php

namespace Colizen\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

class Cycle extends EntityRepository
{

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getCyclesQueryBuilder()
    {
        return $this->getEntityManager()
                    ->createQueryBuilder()
                    ->select('c')
                    ->from('ColizenAdminBundle:Cycle', 'c');

    }

    /**
     * @return array
     */
    public function getCycles()
    {
        return $this->getNotExcludedCyclesQueryBuilder()
                    ->getQuery()
                    ->getResult();
    }
    /**
     * 
     * @param type $code
     * @return type
     */
    public function findByTourCode($code){
        $query=$this->getEntityManager()->createQuery('SELECT c FROM '.$this->getEntityName().' c WHERE REGEXP(:code, c.tourCodeFormat) = 1');
        $query->setParameter('code', $code);
        return $query->getResult();
    }
}
