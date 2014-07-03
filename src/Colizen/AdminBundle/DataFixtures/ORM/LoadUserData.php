<?php

namespace Colizen\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Colizen\UserBundle\Entity\User;

class LoadUserData implements FixtureInterface
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('qmdeveloppement@gmail.com')
            ->setUsername('admin')
            ->setPlainPassword('start123')
            ->setEnabled(true)
            ->setSuperAdmin(true);

        $manager->persist($user);


        $user = new User();
        $user->setEmail('q.morlais@novactive.com')
            ->setUsername('regul')
            ->setPlainPassword('start123')
            ->setEnabled(true)
            ->setRoles(array('ROLE_REGUL'));

        $manager->persist($user);
        
        $user = new User();
        $user->setEmail('sylvodsds@gmail.com')
            ->setUsername('sc')
            ->setPlainPassword('start123')
            ->setEnabled(true)
            ->setRoles(array('ROLE_CUSTOMER_SERVICE'));

        $manager->persist($user);

        $manager->flush();
    }
}
