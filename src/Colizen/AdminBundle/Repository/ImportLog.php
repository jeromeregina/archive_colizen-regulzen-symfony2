<?php

namespace Colizen\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Colizen\AdminBundle\Entity\ImportLog as Entity;

class ImportLog extends EntityRepository
{
    /**
     * 
     * @return array containing 'latest_import_action_date' and 'latest_content_update_date'
     */
    public function findLatestImportLogDates(){
        return array('latest_import_action_date'=>$this->findLatestImportActionDate(),'latest_content_update_date'=>$this->findLatestContentUpdateDate());
    }
    
    public function findLatestImportActionDate(){
        $qb=$this->createQueryBuilder('il');
        $qb->select('MAX(il.date)')
            ->where('il.level = :level')
            ->setParameter('level', Entity::MESSAGE_LEVEL_ACTION);
        $lastest=$qb->getQuery()->getSingleScalarResult();
        return (is_string($lastest))?new \DateTime($lastest):false;
    }
    
    public function findLatestContentUpdateDate(){
        $qb=$this->createQueryBuilder('il');
        $qb->select('MAX(il.date)')
            ->where('il.level = :level')
            ->setParameter('level', Entity::MESSAGE_LEVEL_LINE);
        $lastest=$qb->getQuery()->getSingleScalarResult();
        return (is_string($lastest))?new \DateTime($lastest):false;
    }
    public function findAllSortedByDateDesc($getQuery=false){
        $qb=$this->createQueryBuilder('il');
        $qb->select('il')
            ->orderBy('il.date','DESC');
        $query=$qb->getQuery();
        
        return ($getQuery)?$query:$query->execute();
    }
}
