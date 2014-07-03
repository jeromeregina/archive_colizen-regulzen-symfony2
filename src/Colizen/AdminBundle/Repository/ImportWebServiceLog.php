<?php

namespace Colizen\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Colizen\AdminBundle\Entity\ImportWebServiceLog as Entity;

class ImportWebServiceLog extends EntityRepository
{
    /**
     * @return array containing 'latest_import_action_date' and 'latest_content_update_date'
     */
    public function findLatestImportLogDates(){
        return array('latest_import_action_date'=>$this->findLatestImportActionDate(),'latest_content_update_date'=>$this->findLatestContentUpdateDate());
    }
    /**
     * 
     * @return \DateTime
     */
    public function findLatestImportActionDate(){
        $qb=$this->createQueryBuilder('il');
        $qb->select('MAX(il.date)')
            ->where('il.level = :level')
            ->setParameter('level', Entity::MESSAGE_LEVEL_GLOBAL);
        $lastest=$qb->getQuery()->getSingleScalarResult();
        return (is_string($lastest))?new \DateTime($lastest):false;
    }
    /**
     * 
     * @return \DateTime
     */
    public function findLatestContentUpdateDate(){
        $qb=$this->createQueryBuilder('il');
        $qb->select('MAX(il.date)')
            ->where('il.level = :level')
            ->setParameter('level', Entity::MESSAGE_LEVEL_CALL);
        $lastest=$qb->getQuery()->getSingleScalarResult();
        return (is_string($lastest))?new \DateTime($lastest):false;
    }
    
    public function findAllSortedByIdDesc($getQuery=false){
        $qb=$this->createQueryBuilder('il');
        $qb->select('il')
            ->orderBy('il.id','DESC');
        $query=$qb->getQuery();
        
        return ($getQuery)?$query:$query->execute();
    }
}
