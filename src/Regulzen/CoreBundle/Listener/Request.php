<?php

namespace Regulzen\CoreBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Security\Core\SecurityContext;

class Request
{
    /**
     *
     * @var int session_lock_time converted in seconds
     */
    protected $sessionLockTime;
    /**
     *
     * @var SecurityContext
     */
    protected $sc;
    protected $flashbag;
    protected $translator;
    /**
     *
     * @param int $sessionLockTime session_lock_time in minutes
     */
    public function __construct($sessionLockTime,SecurityContext $sc,$flashbag,$translator)
    {
        $this->sessionLockTime=(int) $sessionLockTime * 60;
        $this->sc=$sc;
        $this->flashbag = $flashbag;
        $this->translator = $translator;
    }

    public function sessionIdleTimeCheck(GetResponseEvent $event)
    {
        if (HttpKernel::MASTER_REQUEST != $event->getRequestType()) {
            return;
        }
        /* si la session est null ne rien faire */
        if ($session = $event->getRequest()->getSession()) {
            if (time() - $session->getMetadataBag()->getLastUsed() > $this->sessionLockTime) {
                $this->sc->setToken(null);
                $session->invalidate();
                $this->flashbag->error($this->translator->trans('regulzen.flash.error.logout_on_session_expired',array('%minutes%'=>$this->sessionLockTime/60)));
            }
        }
    }

}
