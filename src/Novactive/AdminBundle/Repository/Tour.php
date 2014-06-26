<?php

namespace Novactive\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Novactive\AdminBundle\Entity\Tour as Entity;

class Tour extends EntityRepository
{
    /**
     * returns existing Tour or new one by if missing
     * !Todo
     * @param string $code
     * @return \Novactive\AdminBundle\Entity\Tour
     */
    public function resolve($code,$date){
//
//           $existing=$this->findOneBy(array('code'=>$code));
//           
//           if ($existing instanceof Entity)
//               return $existing;
//           
//           $new= new Entity();
//           $new->setCode($code);
//           $cycle=$this->_em->getRepository('NovactiveAdminBundle:Cycle')->findByTourCode($code);
//           $new->setCode($code)
//                ->setCycle($cycle);
           
           return $new;

        }
}
