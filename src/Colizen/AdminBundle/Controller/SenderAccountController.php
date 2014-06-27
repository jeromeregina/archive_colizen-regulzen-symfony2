<?php

namespace Colizen\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Colizen\AdminBundle\Entity\SenderAccount;
use Colizen\AdminBundle\Form\SenderAccountType;

/**
 * SenderAccount controller.
 *
 * @Route("/sender_account")
 */
class SenderAccountController extends Controller
{

    /**
     * Lists all SenderAccount entities.
     *
     * @Route("/", name="admin_sender_account_list")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ColizenAdminBundle:SenderAccount')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new SenderAccount entity.
     *
     * @Route("/", name="admin_sender_account_create")
     * @Method("POST")
     * @Template("ColizenAdminBundle:SenderAccount:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new SenderAccount();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_sender_account_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a SenderAccount entity.
    *
    * @param SenderAccount $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(SenderAccount $entity)
    {
        $form = $this->createForm(new SenderAccountType(), $entity, array(
            'action' => $this->generateUrl('admin_sender_account_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'regulzen.admin.create'));

        return $form;
    }

    /**
     * Displays a form to create a new SenderAccount entity.
     *
     * @Route("/new", name="admin_sender_account_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new SenderAccount();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a SenderAccount entity.
     *
     * @Route("/{id}", name="admin_sender_account_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColizenAdminBundle:SenderAccount')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SenderAccount entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing SenderAccount entity.
     *
     * @Route("/{id}/edit", name="admin_sender_account_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColizenAdminBundle:SenderAccount')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SenderAccount entity.');
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
    * Creates a form to edit a SenderAccount entity.
    *
    * @param SenderAccount $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SenderAccount $entity)
    {
        $form = $this->createForm(new SenderAccountType(), $entity, array(
            'action' => $this->generateUrl('admin_sender_account_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'regulzen.admin.update'));

        return $form;
    }
    /**
     * Edits an existing SenderAccount entity.
     *
     * @Route("/{id}", name="admin_sender_account_update")
     * @Method("PUT")
     * @Template("ColizenAdminBundle:SenderAccount:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColizenAdminBundle:SenderAccount')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SenderAccount entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_sender_account_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a SenderAccount entity.
     *
     * @Route("/{id}", name="admin_sender_account_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ColizenAdminBundle:SenderAccount')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SenderAccount entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_sender_account_list'));
    }

    /**
     * Creates a form to delete a SenderAccount entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_sender_account_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'regulzen.admin.delete','attr'=>array('type'=>'danger','icon'=>'trash')))
            ->getForm()
        ;
    }
}
