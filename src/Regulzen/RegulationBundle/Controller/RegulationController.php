<?php

namespace Regulzen\RegulationBundle\Controller;

use Regulzen\RegulationBundle\Form\Model\DateCycleFormModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 *  @Route("/")
 */
class RegulationController extends Controller
{
    /**
     * @Route("/",name="regulzen_regulation_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $shipments = array();

        $cycles = $this->getDoctrine()
            ->getRepository('RegulzenCoreBundle:Cycle')
            ->findAll();

        $currentDateTime = new \DateTime('now');
        foreach ($cycles as $cycle) {
            if ($cycle->getStart() < $currentDateTime && $currentDateTime < $cycle->getEnd()) {
                $currentCycle = $cycle;
            }
        }

        $dateCycle = new DateCycleFormModel();
        $dateCycle->setCycle($currentCycle);

        $dateCycleForm = $this->createForm('date_cycle', $dateCycle);
        $dateCycleForm->handleRequest($request);
        if ($dateCycleForm->isValid()) {
            $dateCycle = $dateCycleForm->getData();
        }

        /* @var $tableauNationalService \Regulzen\RegulationBundle\Service\TableauNationalInterface */
        $tableauNationalService = $this->get('regulzen_regulation.service.tableau_national');
        $sitesData = $tableauNationalService->getTableauNational($dateCycle->getDate(), $dateCycle->getCycle());



        return $this->render('RegulzenRegulationBundle:Regulation:index.html.twig', array('dateCycleForm' => $dateCycleForm->createView(),
                                       'shipments'     => $shipments,
                                       'sitesData'     => $sitesData
        ));
    }

    /**
     * @param $siteId
     *
     * @return JsonResponse
     */
    public function sitToursAction($siteId)
    {
        $request = $this->get('request_stack')->getCurrentRequest();

            $site = $this->getDoctrine()
                         ->getRepository('RegulzenCoreBundle:Site')
                         ->find($siteId);
            if ( ! $site)
            {
                return new JsonResponse('Cycle non trouvé', 500);
            }

            $cycleId = $request->get('cycle', 0);

            if ($cycleId === 0)
            {
                $cycles = $this->getDoctrine()
                    ->getRepository('RegulzenCoreBundle:Cycle')
                    ->findAll();
                $cycle = $cycles[0];
            }
            else
            {
                $cycle = $this->getDoctrine()
                    ->getRepository('RegulzenCoreBundle:Cycle')
                    ->find($cycleId);

                if ( ! $cycle)
                {
                    return new JsonResponse('Cycle non trouvé', 500);
                }
            }


            $date = $request->get('date', date('Y-m-d'));
            $date = \DateTime::createFromFormat('Y-m-d', $date);

            /* @var $tableauNationalService \Regulzen\RegulationBundle\Service\TableauNationalInterface */
            $tableauNationalService = $this->get('regulzen_regulation.service.tableau_national');

            $toursData = $tableauNationalService->getTableauTournees($date, $cycle, $site);

            return new JsonResponse($toursData);
    }
}
