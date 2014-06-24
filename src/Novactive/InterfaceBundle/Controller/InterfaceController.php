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
        $shipments = array();
        $dateCycleForm = $this->createForm('date_cycle', new DateCycleFormModel());

        $cycles = $this->getDoctrine()
            ->getRepository('NovactiveAdminBundle:Cycle')
            ->findAll();

        $currentDateTime = new \DateTime('now');
        foreach ($cycles as $cycle)
        {
            if ($cycle->getStart() < $currentDateTime && $currentDateTime < $cycle->getEnd())
            {
                $currentCycle = $cycle;
            }
        }

        $dateCycleForm->get('cycle')->setData($currentCycle);


        $dateCycleForm->handleRequest($request);
        if ($dateCycleForm->isValid())
        {
            $dateCycle = $dateCycleForm->getData();

        }

        return array(
            'dateCycleForm' => $dateCycleForm->createView(),
            'shipments'     => $shipments
        );
    }
}
