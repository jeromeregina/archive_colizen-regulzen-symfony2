<?php

namespace Regulzen\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Regulzen\UserBundle\Entity\User;

class LoadUserData implements FixtureInterface
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('admin@novactive.com')
            ->setUsername('admin')
            ->setPlainPassword('admin')
            ->setEnabled(true)
            ->setSuperAdmin(true);

        $manager->persist($user);

        $user = new User();
        $user->setEmail('regul@novactive.com')
            ->setUsername('regul')
            ->setPlainPassword('regul')
            ->setEnabled(true)
            ->setRoles(array('ROLE_REGUL'));

        $manager->persist($user);

        $user = new User();
        $user->setEmail('service_client@novactive.com')
            ->setUsername('service_client')
            ->setPlainPassword('service_client')
            ->setEnabled(true)
            ->setRoles(array('ROLE_CUSTOMER_SERVICE'));

        $manager->persist($user);

        $manager->flush();
    }
}
