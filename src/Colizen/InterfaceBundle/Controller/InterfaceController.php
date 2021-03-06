<?php

namespace Colizen\InterfaceBundle\Controller;

use Colizen\AdminBundle\Repository\Site;
use Colizen\InterfaceBundle\Form\Model\DateCycleFormModel;
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


        $cycles = $this->getDoctrine()
            ->getRepository('ColizenAdminBundle:Cycle')
            ->findAll();

        $currentDateTime = new \DateTime('now');
        foreach ($cycles as $cycle)
        {
            if ($cycle->getStart() < $currentDateTime && $currentDateTime < $cycle->getEnd())
            {
                $currentCycle = $cycle;
            }
        }

        $dateCycle = new DateCycleFormModel();
        $dateCycle->setCycle($currentCycle);

        $dateCycleForm = $this->createForm('date_cycle', $dateCycle);
        $dateCycleForm->handleRequest($request);
        if ($dateCycleForm->isValid())
        {
            $dateCycle = $dateCycleForm->getData();
        }

        /* @var $tableauNationalService \Colizen\InterfaceBundle\Service\TableauNationalInterface */
        $tableauNationalService = $this->get('colizen_interface.service.tableau_national');
        $sitesData = $tableauNationalService->getTableauNational($dateCycle->getDate(), $dateCycle->getCycle());

        return array(
            'dateCycleForm' => $dateCycleForm->createView(),
            'shipments'     => $shipments,
            'sitesData'     => $sitesData
        );
    }
}
