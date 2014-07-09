<?php

namespace Regulzen\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;

class User extends EntityRepository
{
    /**
     *
     * @return array of admin emails
     */
    public function getAllAdminEmails()
    {
        $qb=$this->createQueryBuilder('u');
        $qb->select('u.email')
           ->where($qb->expr()->like('u.roles', ':admin'))
                ->setParameter('admin', '%"ROLE_ADMIN"%');
        $ret=array();
        foreach ($qb->getQuery()->getArrayResult() as $entry) {
            $ret[]=$entry['email'];
                    }

        return $ret;
    }

}
