<?php

namespace Novactive\InterfaceBundle\Controller;

use Novactive\InterfaceBundle\Form\Model\DateCycleFormModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 *  @Route("/")
 */
class InterfaceController extends Controller
{
    /**
     * @Route("/",name="regulzen_interface_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
//        $shipmentRepository = $this->getDoctrine()
//            ->getEntityManager()
//            ->getRepository('NovactiveAdminBundle:Shipment');

        $shipments = array();

        $dateCycleForm = $this->createForm('date_cycle', new DateCycleFormModel());

        $dateCycleForm->handleRequest($request);
        if ($dateCycleForm->isValid())
        {
            $dateCycle = $dateCycleForm->getData();

            //$shipments = $shipmentRepository->findShipments($dateCycle->getDate(), $dateCycle->getCycle());
        }

        return array(
            'dateCycleForm' => $dateCycleForm->createView(),
            'shipments'     => $shipments
        );
    }
}
