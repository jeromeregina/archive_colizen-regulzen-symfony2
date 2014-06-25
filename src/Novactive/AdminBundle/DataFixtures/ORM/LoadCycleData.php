<?php

namespace Novactive\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Novactive\AdminBundle\Entity\Cycle;

class LoadCycleData implements FixtureInterface
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $cycle = new Cycle();
        $cycle->setName('Matin')
            ->setStart(\DateTime::createFromFormat('H:i:s', '00:00:00'))
            ->setEnd(\DateTime::createFromFormat('H:i:s', '12:59:00'))
            ->setTourCodeFormat('^(1|2|3)\d{2}$')
                ;
        $manager->persist($cycle);

        $cycle = new Cycle();
        $cycle->setName('Après Midi')
            ->setStart(\DateTime::createFromFormat('H:i:s', '13:00:00'))
            ->setEnd(\DateTime::createFromFormat('H:i:s', '21:59:00'))
            ->setTourCodeFormat('^(7)\d{2}$')
                ;
        $manager->persist($cycle);

        $cycle = new Cycle();
        $cycle->setName('Soir')
            ->setStart(\DateTime::createFromFormat('H:i:s', '22:00:00'))
            ->setEnd(\DateTime::createFromFormat('H:i:s', '23:59:00'))
            ->setTourCodeFormat('^(8)\d{2}$')
                ;
        $manager->persist($cycle);



        $manager->flush();
    }
}