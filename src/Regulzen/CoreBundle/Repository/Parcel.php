<?php

namespace Regulzen\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Regulzen\CoreBundle\Entity\Parcel as Entity;

class Parcel extends EntityRepository
{
    /**
     * returns existing Parcel or new one by if missing
     *
     * @param  string                             $cargopass of format <i>xxxyyy123456789</i>
     * @return \Regulzen\CoreBundle\Entity\Parcel
     */
    public function resolveByCargopass($cargopass)
    {
           $parcel=$this->findOneBy(array('cargopass'=>$cargopass));

           return ($parcel instanceof Entity)?$parcel:new Entity();

        }
}
