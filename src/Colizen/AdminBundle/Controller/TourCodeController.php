<?php

namespace Colizen\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Colizen\AdminBundle\Entity\TourCode;
use Colizen\AdminBundle\Form\TourCodeType;

/**
 * TourCode controller.
 *
 * @Route("/tourcode")
 */
class TourCodeController extends Controller
{

    /**
     * Lists all TourCode entities.
     *
     * @Route("/", name="admin_tour_code_list")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ColizenAdminBundle:TourCode')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new TourCode entity.
     *
     * @Route("/", name="admin_tour_code_create")
     * @Method("POST")
     * @Template("ColizenAdminBundle:TourCode:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TourCode();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $flash = $this->get('braincrafted_bootstrap.flash');
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            $flash->info($this->get('translator')->trans('regulzen.admin.entity.created',array('%entity%'=>'site','%id%'=>$entity->getId())));
            
            return $this->redirect($this->generateUrl('admin_tour_code_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a TourCode entity.
    *
    * @param TourCode $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(TourCode $entity)
    {
        $form = $this->createForm(new TourCodeType(), $entity, array(
            'action' => $this->generateUrl('admin_tour_code_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TourCode entity.
     *
     * @Route("/new", name="admin_tour_code_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TourCode();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TourCode entity.
     *
     * @Route("/{id}", name="admin_tour_code_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColizenAdminBundle:TourCode')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TourCode entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TourCode entity.
     *
     * @Route("/{id}/edit", name="admin_tour_code_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColizenAdminBundle:TourCode')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TourCode entity.');
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
    * Creates a form to edit a TourCode entity.
    *
    * @param TourCode $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TourCode $entity)
    {
        $form = $this->createForm(new TourCodeType(), $entity, array(
            'action' => $this->generateUrl('admin_tour_code_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TourCode entity.
     *
     * @Route("/{id}", name="admin_tour_code_update")
     * @Method("PUT")
     * @Template("ColizenAdminBundle:TourCode:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColizenAdminBundle:TourCode')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TourCode entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            
            $flash = $this->get('braincrafted_bootstrap.flash');
            
            $flash->info($this->get('translator')->trans('regulzen.admin.entity.updated',array('%entity%'=>'site','%id%'=>$entity->getId())));
            
            return $this->redirect($this->generateUrl('admin_tour_code_list'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a TourCode entity.
     *
     * @Route("/{id}", name="admin_tour_code_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        $flash = $this->get('braincrafted_bootstrap.flash');
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ColizenAdminBundle:TourCode')->find($id);
            try {
                
                if (!$entity) {
                    throw $this->createNotFoundException('Unable to find TourCode entity.');
                }

                $em->remove($entity);
                $em->flush();
             $flash->error($this->get('translator')->trans('regulzen.admin.entity.deleted',array('%entity%'=>'site','%id%'=>$entity->getId())));
            } catch (\Exception $e){
                $flash->error($this->get('translator')->trans('regulzen.admin.entity.error.deletion',array('%entity%'=>'site','%id%'=>$entity->getId(),'%message%'=>$e->getMessage())));
            }
        }

        return $this->redirect($this->generateUrl('admin_tour_code_list'));
    }

    /**
     * Creates a form to delete a TourCode entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_tour_code_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'regulzen.admin.delete','attr'=>array('type'=>'danger','icon'=>'trash')))
            ->getForm()
        ;
    }
}
