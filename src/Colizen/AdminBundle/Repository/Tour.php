<?php

namespace Colizen\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Colizen\AdminBundle\Entity\Tour as Entity;
use Colizen\AdminBundle\Entity\Site as SiteEntity;

class Tour extends EntityRepository
{
    /**
     * returns existing Tour or new one by if missing
     * @param string $code
     * @param \DateTime $date
     * @param \Colizen\AdminBundle\Entity\Site
     * @return \Colizen\AdminBundle\Entity\Tour
     */
    public function resolveByTourCodeDateAndSite($code,\DateTime $date,SiteEntity $site){
           $tourCode =  $this->_em->getRepository('ColizenAdminBundle:TourCode')->resolveByCode($code);
             
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
