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
//        echo "<pre>";
//        $this->get('novactive_admin.importer.tour_planning')->execute();
////        $this->get('novactive_admin.importer.parcel_details')->execute();
//        echo "</pre>";die;
//        $wsParams=$this->container->getParameter('czn_webservice');
//        $client=new \SoapClient($wsParams['wsdl_location']);
//        
//        $wsReq=$wsParams;
//        unset($wsReq['wsdl_location']);
//        $wsReq+=array(
//            'customer_center'=>'750',
//            'shipmentnumber'=>"250750002582962"
//        );
        echo "<pre>";
//        var_dump($client->__getFunctions());
//        var_dump($client->__getTypes());
        foreach (array('250750002545289','2507502583059')as $ssp){
//            foreach (array($ssp,substr($ssp,0,-3),substr($ssp,0,-4),substr($ssp,0,-5)) as $sp){
            echo ("env : ".$ssp. " <br/>");
            echo ("ret : ".var_dump($this->get('webservice')->getShipmentTrace(750,$ssp)). " <br/>");
//            }
            echo ('---------<br/>');
        }
        echo "</pre>";
        die;
//        return array();
    }
}
