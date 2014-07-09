<?php

namespace Regulzen\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Regulzen\CoreBundle\Entity\ImportLog;

/**
 * Logs controller.
 *
 * @Route("/logs")
 */
class LogsController extends Controller
{

    /**
     * Lists all Logs entities sorted by Id Desc.
     * !Todo: il faudrait éventuellement rétablir le tri par date lors de la migration vers PostgreSql
     * ! (dans le cas ou Doctrine2 gère correctement les milliseconds sur les dates Postgre)
     * ! aujourd'hui le tri se fait par id car plus précis
     *
     * @Route("/imports", name="admin_logs_imports_list")
     * @Method("GET")
     * @Template()
     */
    public function importsListAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $query=$em->getRepository('RegulzenCoreBundle:ImportLog')->findAllSortedByIdDesc(true);

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
    /**
     * Lists all Logs entities sorted by Id Desc.
     *
     * @Route("/imports_web_service", name="admin_logs_imports_web_service_list")
     * @Method("GET")
     * @Template()
     */
    public function importsWebServiceListAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $query=$em->getRepository('RegulzenCoreBundle:ImportWebServiceLog')->findAllSortedByIdDesc(true);

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
