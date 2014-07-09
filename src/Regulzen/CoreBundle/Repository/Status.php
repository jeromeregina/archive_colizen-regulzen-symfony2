<?php
namespace Regulzen\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class Status extends EntityRepository
{
    /**
     *
     * @return \Doctrine\ORM\Query
     */
    public function findAllQuery()
    {
        $qb=$this->createQueryBuilder('s');

        return $qb->select('s')->getQuery();
    }
}
