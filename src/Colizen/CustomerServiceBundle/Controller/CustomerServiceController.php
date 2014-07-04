<?php

namespace Colizen\CustomerServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/")
 */
class CustomerServiceController extends Controller
{
    /**
     * @Route("/", name="customer_service_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
		$em = $this->getDoctrine()->getManager();
		$query = $em->getRepository('ColizenAdminBundle:CustomerServiceRequest')->findAllSortByDate();

		$paginator  = $this->get('knp_paginator');

		$page = $request->get('page', 1);

		$pagination = $paginator->paginate(
			$query,
			$page,
			7
		);

		return array(
			'pagination' => $pagination,
		);
    }
}
