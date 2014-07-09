<?php

namespace Regulzen\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Regulzen\CoreBundle\Entity\Site;

class LoadSiteData implements FixtureInterface
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $site = new Site();
        $site->setName('Paris')
             ->setCodeRegulzen('K18')
             ->setCodeImtech('CAP18')
             ->setIsActive(true)
             ->setNumber(750);
        $manager->persist($site);

        $site = new Site();
        $site->setName('Lyon')
             ->setCodeRegulzen('LYS')
             ->setCodeImtech('LYS')
             ->setIsActive(true)
             ->setNumber(690);
        $manager->persist($site);

        $site = new Site();
        $site->setName('Lille')
             ->setCodeRegulzen('LIL')
             ->setCodeImtech('LIL')
             ->setIsActive(true)
             ->setNumber(590);
        $manager->persist($site);

        $site = new Site();
        $site->setName('Marseille')
             ->setCodeRegulzen('OMV')
             ->setCodeImtech('OMV')
             ->setIsActive(true)
             ->setNumber(130);
        $manager->persist($site);

        $manager->flush();
    }
}
