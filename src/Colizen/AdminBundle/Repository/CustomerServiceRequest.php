<?php
/**
 * Created by PhpStorm.
 * User: jeanpaul
 * Date: 04/07/2014
 * Time: 14:41
 */

namespace Colizen\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CustomerServiceRequest extends EntityRepository
{
	public function findAllSortByDate() {
		return $this->createQueryBuilder('csr')
			->select()
			->orderBy('csr.created', 'DESC')
			->getQuery();
	}
}
