<?php

namespace Colizen\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Colizen\AdminBundle\Entity\Tour as Entity;

class Tour extends EntityRepository
{
    /**
     * returns existing Tour or new one by if missing
     * !Todo
     * @param string $code
     * @return \Colizen\AdminBundle\Entity\Tour
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
//           $cycle=$this->_em->getRepository('ColizenAdminBundle:Cycle')->findByTourCode($code);
//           $new->setCode($code)
//                ->setCycle($cycle);
           
           return $new;

        }
}
