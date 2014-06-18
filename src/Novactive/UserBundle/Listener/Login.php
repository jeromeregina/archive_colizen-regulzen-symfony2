<?php
namespace Novactive\UserBundle\Listener;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Doctrine\ORM\EntityManagerInterface; 
use Doctrine\ORM\EntityManager; 
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class Login {
    /**
     *
     * @var EntityManager
     */
    private $em;
    /**
     *
     * @var Session
     */
    private $session;
    public function __construct(EntityManagerInterface $em, Session $session) {
        $this->em=$em;
        $this->session =$session;
    }
    
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event){
       $user = $event->getAuthenticationToken()->getUser();
        if ($user instanceof UserInterface) {
            $sessionRepo=$this->em->getRepository('NovactiveAdminBundle:Session');
//            si l'on veu 'déloger' l'utilisateur déjà loggué
//            $existingSessions=$sessionRepo->findByUser($user);
//            foreach ($existingSessions as $es){
//                $this->em->remove($es);
//            }
            $sessionObject=$sessionRepo->findOneById($this->session->getId());
            $sessionObject->setUser($user);
            $this->em->flush();
        }
    }
}
