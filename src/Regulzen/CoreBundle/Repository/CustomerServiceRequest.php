<?php

namespace Regulzen\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CustomerServiceRequest extends EntityRepository
{
    public function findAllSortByDate()
    {
        return $this->createQueryBuilder('csr')
            ->select()
            ->orderBy('csr.created', 'DESC')
            ->getQuery();
    }
}
