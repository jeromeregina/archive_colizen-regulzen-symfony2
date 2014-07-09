<?php

namespace Regulzen\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

use Regulzen\CoreBundle\Entity\TourCode as Entity;

class TourCode extends EntityRepository
{
     /**
     * returns existing TourCode or new one by if missing
     *
     * @param  string                               $code
     * @return \Regulzen\CoreBundle\Entity\TourCode
     */
    public function resolveByCode($code)
    {
           $existing=$this->findOneBy(array('code'=>$code));

           if ($existing instanceof Entity)
               return $existing;

           $new= new Entity();
           $new->setCode($code);
           $cycles=$this->_em->getRepository('RegulzenCoreBundle:Cycle')->findByTourCode($code);

           foreach ($cycles as $cycle) {
                $new->addCycle($cycle);
           }

           return $new;

        }
}
