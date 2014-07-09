<?php

namespace Regulzen\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Regulzen\CoreBundle\Entity\Tour as Entity;
use Regulzen\CoreBundle\Entity\Site as SiteEntity;

class Tour extends EntityRepository
{
    /**
     * returns existing Tour or new one by if missing
     * @param  string                           $code
     * @param  \DateTime                        $date
     * @param \Regulzen\CoreBundle\Entity\Site
     * @return \Regulzen\CoreBundle\Entity\Tour
     */
    public function resolveByTourCodeDateAndSite($code,\DateTime $date,SiteEntity $site)
    {
           $tourCode =  $this->_em->getRepository('RegulzenCoreBundle:TourCode')->resolveByCode($code);

           $existing=$this->findOneBy(array('tourCode'=>$tourCode,'date'=>$date,'site'=>$site));

           if ($existing instanceof Entity)
               return $existing;

            $new = new Entity();
            $new->setSite($site)
                 ->setTourCode($tourCode)
                 ->setDate($date);

           return $new;

        }
}
