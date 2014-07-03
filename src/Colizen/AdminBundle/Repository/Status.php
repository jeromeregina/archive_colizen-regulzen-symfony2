<?php
namespace Colizen\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

class Status extends EntityRepository{
    /**
     * 
     * @return \Doctrine\ORM\Query
     */
    public function findAllQuery(){
        
        $qb=$this->createQueryBuilder('s');
        
        return $qb->select('s')->getQuery();
    }
    /**
     * récupère le status de type "PLANIF"
     * 
     * @return \Colizen\AdminBundle\Entity\Status
     */
    public function getPlanif(){
        return $this->find(-1);
    }
}
