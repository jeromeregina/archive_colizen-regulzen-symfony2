<?php

namespace Colizen\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Colizen\AdminBundle\Entity\Status;
use Colizen\AdminBundle\Form\StatusType;

/**
 * Status controller.
 *
 * @Route("/status")
 */
class StatusController extends Controller
{

    /**
     * Lists all Status entities.
     *
     * @Route("/", name="admin_status_list")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $query=$em->getRepository('ColizenAdminBundle:Status')->findAllQuery();

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
     * Creates a new Status entity.
     *
     * @Route("/", name="admin_status_create")
     * @Method("POST")
     * @Template("ColizenAdminBundle:Status:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Status();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $flash = $this->get('braincrafted_bootstrap.flash');
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $flash->info($this->get('translator')->trans('regulzen.admin.entity.created',array('%entity%'=>'site','%id%'=>$entity->getCode())));
  
            return $this->redirect($this->generateUrl('admin_status_show', array('id' => $entity->getCode())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Status entity.
    *
    * @param Status $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Status $entity)
    {
        $form = $this->createForm(new StatusType(), $entity, array(
            'action' => $this->generateUrl('admin_status_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Status entity.
     *
     * @Route("/new", name="admin_status_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Status();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Status entity.
     *
     * @Route("/{id}", name="admin_status_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColizenAdminBundle:Status')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Status entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Status entity.
     *
     * @Route("/{id}/edit", name="admin_status_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColizenAdminBundle:Status')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Status entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Status entity.
    *
    * @param Status $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Status $entity)
    {
        $form = $this->createForm(new StatusType(), $entity, array(
            'action' => $this->generateUrl('admin_status_update', array('id' => $entity->getCode())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Status entity.
     *
     * @Route("/{id}", name="admin_status_update")
     * @Method("PUT")
     * @Template("ColizenAdminBundle:Status:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColizenAdminBundle:Status')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Status entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $flash = $this->get('braincrafted_bootstrap.flash');
            
            $flash->info($this->get('translator')->trans('regulzen.admin.entity.updated',array('%entity%'=>'site','%id%'=>$entity->getCode())));
            
            return $this->redirect($this->generateUrl('admin_status_list'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Status entity.
     *
     * @Route("/{id}", name="admin_status_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        $flash = $this->get('braincrafted_bootstrap.flash');
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ColizenAdminBundle:Status')->find($id);
            try {
                if (!$entity) {
                    throw $this->createNotFoundException('Unable to find Status entity.');
                }

                $em->remove($entity);
                $em->flush();
             $flash->error($this->get('translator')->trans('regulzen.admin.entity.deleted',array('%entity%'=>'site','%id%'=>$entity->getCode())));
            } catch (\Exception $e){
                $flash->error($this->get('translator')->trans('regulzen.admin.entity.error.deletion',array('%entity%'=>'site','%id%'=>$entity->getCode(),'%message%'=>$e->getMessage())));
            }
        }

        return $this->redirect($this->generateUrl('admin_status_list'));
    }

    /**
     * Creates a form to delete a Status entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_status_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'regulzen.admin.delete','attr'=>array('type'=>'danger','icon'=>'trash')))
            ->getForm()
        ;
    }
}
