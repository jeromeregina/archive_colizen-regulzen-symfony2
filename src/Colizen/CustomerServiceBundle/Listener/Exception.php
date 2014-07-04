<?php

namespace Colizen\CustomerServiceBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Exception
{
    /**
     *
     * @var SecurityContext 
     */
    protected $sc;
    /**
     *
     * @var RouterInterface 
     */
    protected $router;
    public function __construct(SecurityContext $sc, RouterInterface $router) {
        $this->sc=$sc;
        $this->router=$router;
    }
    public function onForbiddenException(GetResponseForExceptionEvent $event)
    {
       if ($this->sc->getToken()!=null){
            $user=$this->sc->getToken()->getUser();
            if ($event->getException() instanceof AccessDeniedHttpException && $user!=null && $user->hasRole('ROLE_CUSTOMER_SERVICE')){
                $event->setResponse(new RedirectResponse($this->router->generate('customer_service_index')));
            }
       }
    }
}