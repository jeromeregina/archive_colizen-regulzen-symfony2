<?php

namespace Colizen\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Colizen\UserBundle\Entity\User;

class LoadSiteData implements FixtureInterface
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $manager->flush();
    }
}
