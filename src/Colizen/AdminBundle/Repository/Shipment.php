<?php

namespace Colizen\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

use Colizen\AdminBundle\Entity\Shipment as Entity;

class Shipment extends EntityRepository
{
    /**
     * returns existing Shipment or new one by if missing
     * 
     * @param string $cargopass of format <i>123-123-123456789 123</i>
     * @return \Colizen\AdminBundle\Entity\Shipment
     */
    public function resolveByCargopass($cargopass){

           $shipment=$this->findOneBy(array('cargopass'=>$cargopass));
           return ($shipment instanceof Entity)?$shipment:new Entity();

        }
}