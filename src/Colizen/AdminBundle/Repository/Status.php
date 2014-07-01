<?php
namespace Colizen\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

class Status extends EntityRepository{
    public function findAllQuery(){
        $qb=$this->createQueryBuilder('s');
        return $qb->select('s')->getQuery();
    }
}
