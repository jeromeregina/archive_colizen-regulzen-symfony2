<?php

namespace Novactive\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    /**
     * @Route("/soap")
     * @Template()
     */
    public function soapAction(Request $request)
    {
        echo "<pre>";
        $this->get('novactive_admin.importer.tour_planning')->execute();
        echo "</pre>";die;
//        $wsdl=$this->container->getParameter('czn_webservices_wsdl_location');
//        $client=new \SoapClient($wsdl);
//        echo "<pre>";
//        var_dump($client->__getFunctions());
//        var_dump($client->__getTypes());
//        echo "</pre>";
//        die;
        return array();
    }
}
