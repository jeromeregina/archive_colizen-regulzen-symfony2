<?php

namespace Novactive\InterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
/**
 *  @Route("/")
 */
class InterfaceController extends Controller
{
    /**
     * @Route("/",name="regulzen_interface_index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
