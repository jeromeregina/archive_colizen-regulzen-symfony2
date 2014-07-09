<?php

namespace Regulzen\UserBundle\Security;

use Symfony\Component\Security\Core\User\UserChecker as BaseChecker;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Regulzen\CoreBundle\Entity\Session as ESession;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class UserChecker extends BaseChecker
{
     /**
     *
     * @var EntityManager
     */
    private $em;

    /**
     * time in minute session should last
     * @var int
     */
    private $sessionLockTime;

    public function __construct(EntityManagerInterface $em, $sessionLockTime)
    {
        $this->em = $em;
        $this->sessionLockTime = $sessionLockTime * 60;
    }

    public function checkPreAuth(UserInterface $user)
    {
        parent::checkPreAuth($user);
        $existingSessions = $this->em->getRepository('RegulzenCoreBundle:Session')->findByUser($user);
        foreach ($existingSessions as $es) {
            /* @var $es ESession */
            if (time()-$es->getTime() < $this->sessionLockTime) {
                throw new AuthenticationException('security.already_connected.flash.error');
            } else {
                $this->em->remove($es);
                $this->em->flush();
            }
        }
    }
}
