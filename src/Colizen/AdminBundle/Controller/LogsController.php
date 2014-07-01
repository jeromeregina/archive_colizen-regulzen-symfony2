<?php

namespace Colizen\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Colizen\AdminBundle\Entity\ImportLog;

/**
 * Logs controller.
 *
 * @Route("/logs")
 */
class LogsController extends Controller
{

    /**
     * Lists all Cycle entities.
     *
     * @Route("/imports", name="admin_logs_imports_list")
     * @Method("GET")
     * @Template()
     */
    public function importsListAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $query=$em->getRepository('ColizenAdminBundle:ImportLog')->findAllSortedByDateDesc(true);

        $paginator  = $this->get('knp_paginator');
        
        $page=$request->get('page',1);
        
        $pagination = $paginator->paginate(
            $query,
            $page,
            20
        );

        return array(
            'pagination' => $pagination,
        );
    }
}
