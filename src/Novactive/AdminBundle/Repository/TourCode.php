<?php

namespace Novactive\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

use Novactive\AdminBundle\Entity\TourCode as Entity;

class TourCode extends EntityRepository
{
     /**
     * returns existing TourCode or new one by if missing
     * 
     * @param string $code
     * @return \Novactive\AdminBundle\Entity\TourCode
     */
    public function resolveByCode($code){

           $existing=$this->findOneBy(array('code'=>$code));
           
           if ($existing instanceof Entity)
               return $existing;
           
           $new= new Entity();
           $new->setCode($code);
           $cycle=$this->_em->getRepository('NovactiveAdminBundle:Cycle')->findByTourCode($code);
           $new->setCode($code)
                ->setCycle($cycle);
           
           return $new;

        }
}
