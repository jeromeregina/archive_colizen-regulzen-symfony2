<?php

namespace Colizen\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Colizen\AdminBundle\Entity\Site;

class LoadSiteData implements FixtureInterface
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $site = new Site();
        $site->setName('Paris')
             ->setCodeColizen('K18')
             ->setCodeImtech('CAP18')
             ->setIsActive(true)
             ->setNumber(750);
        $manager->persist($site);

        $site = new Site();
        $site->setName('Lyon')
             ->setCodeColizen('LYS')
             ->setCodeImtech('LYS')
             ->setIsActive(true)
             ->setNumber(690);
        $manager->persist($site);

        $site = new Site();
        $site->setName('Lille')
             ->setCodeColizen('LIL')
             ->setCodeImtech('LIL')
             ->setIsActive(true)
             ->setNumber(590);
        $manager->persist($site);

        $site = new Site();
        $site->setName('Marseille')
             ->setCodeColizen('OMV')
             ->setCodeImtech('OMV')
             ->setIsActive(true)
             ->setNumber(130);
        $manager->persist($site);

        $manager->flush();
    }
}
