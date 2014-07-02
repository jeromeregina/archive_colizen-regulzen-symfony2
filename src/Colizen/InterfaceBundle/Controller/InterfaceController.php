<?php

namespace Colizen\InterfaceBundle\Controller;

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

        $siteRepository = $this->getDoctrine()->getRepository('ColizenAdminBundle:Site');

        // Les sites
        $sites = $siteRepository->findAll();
        $sitesData = array();
        foreach ($sites as $site)
        {
            $sitesData[$site->getId()]['site'] = $site;
            $sitesData[$site->getId()]['nombreExpeditions'] = 'N/A';
            $sitesData[$site->getId()]['nombreColis'] = 'N/A';
        }

        // nombre d'expeditions
        $nombreExpeditions = $siteRepository->getNombreExpeditionsBySite($dateCycle->getDate(), $dateCycle->getCycle());

        foreach ($nombreExpeditions as $nombreExpeditionsLine)
        {
            $sitesData[$nombreExpeditionsLine['site']->getId()]['nombreExpeditions'] = $nombreExpeditionsLine['nombreExpeditions'];
        }

        // nombre de colis
        $nombreColis = $siteRepository->getNombreColisBySite($dateCycle->getDate(), $dateCycle->getCycle());
        foreach ($nombreColis as $nombreColisLine)
        {
            $sitesData[$nombreColisLine['site']->getId()]['nombreColis'] = $nombreColisLine['nombreColis'];
        }





        return array(
            'dateCycleForm' => $dateCycleForm->createView(),
            'shipments'     => $shipments,
            'sitesData'     => $sitesData
        );
    }
}
