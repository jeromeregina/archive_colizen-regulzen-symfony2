<?php

namespace Colizen\AdminBundle\Repository;

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
}