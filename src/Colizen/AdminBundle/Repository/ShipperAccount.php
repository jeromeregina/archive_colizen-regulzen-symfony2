<?php

namespace Colizen\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Colizen\AdminBundle\Entity\ShipperAccount as Entity;

class ShipperAccount extends EntityRepository
{
    /**
     * returns existing Tour or new one by if missing
     * 
     * @param string $code
     * @param string $name better add a name if your want to create an account
     * 
     * @return \Colizen\AdminBundle\Entity\ShipperAccount
     */
    public function resolveByCode($code,$name=null){
           $existing=$this->findOneBy(array('code'=>$code));
           
           if ($existing instanceof Entity)
               return $existing;
            
            $new = new Entity();
            $new->setCode($code)
                ->setName(($name!=null)?$name:'unknown');
            
           return $new;

        }
}