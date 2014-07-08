<?php

namespace Colizen\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Colizen\AdminBundle\Entity\CustomerServiceRequest;

/**
 * @Route("/")
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
        /* @var $ws \Colizen\AdminBundle\SoapClient\ColizenWebService */
        $ws=$this->get('colizen_admin.soapclient.czn_webservice');
        $ret=$ws->getShipmentTrace('750','2507500531462');
        echo'<pre>';
        var_dump($ret);die;
    }

    /**
	 * TEST
	 * @param Request $request
	 * @Route("/ajouterdemande")
	 * @Template()
	 */
    public function addCustomerRequestAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $csreq = new CustomerServiceRequest();
        $csreq->setType(CustomerServiceRequest::REQUEST_TYPE_UPDATE)
            ->setDesc('Tournée: 102 / Créneau: 08h-12h / M. Dauly')
            ->setStatus(CustomerServiceRequest::REQUEST_STATUS_WAITING)
            ->setCargopass('12345678')
            ->setTourcode(15)
            ->setStartTime(new \DateTime('now'))
            ->setEndTime(new \DateTime('now'));

        $em->persist($csreq);

        $em->flush();
        die;
    }
}
