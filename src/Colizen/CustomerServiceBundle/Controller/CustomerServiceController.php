<?php

namespace Colizen\CustomerServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/")
 */
class CustomerServiceController extends Controller
{
    /**
     * @Route("/", name="customer_service_index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
