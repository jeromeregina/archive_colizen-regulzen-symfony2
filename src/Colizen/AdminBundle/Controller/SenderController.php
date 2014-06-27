<?php

namespace Colizen\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Colizen\AdminBundle\Entity\Sender;
use Colizen\AdminBundle\Form\SenderType;

/**
 * Sender controller.
 *
 * @Route("/sender")
 */
class SenderController extends Controller
{

    /**
     * Lists all Sender entities.
     *
     * @Route("/", name="admin_sender_list")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ColizenAdminBundle:Sender')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Sender entity.
     *
     * @Route("/", name="admin_sender_create")
     * @Method("POST")
     * @Template("ColizenAdminBundle:Sender:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Sender();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_sender_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Sender entity.
    *
    * @param Sender $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Sender $entity)
    {
        $form = $this->createForm(new SenderType(), $entity, array(
            'action' => $this->generateUrl('admin_sender_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'regulzen.admin.create'));

        return $form;
    }

    /**
     * Displays a form to create a new Sender entity.
     *
     * @Route("/new", name="admin_sender_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Sender();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Sender entity.
     *
     * @Route("/{id}", name="admin_sender_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColizenAdminBundle:Sender')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sender entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Sender entity.
     *
     * @Route("/{id}/edit", name="admin_sender_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColizenAdminBundle:Sender')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sender entity.');
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
    * Creates a form to edit a Sender entity.
    *
    * @param Sender $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Sender $entity)
    {
        $form = $this->createForm(new SenderType(), $entity, array(
            'action' => $this->generateUrl('admin_sender_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'regulzen.admin.update'));

        return $form;
    }
    /**
     * Edits an existing Sender entity.
     *
     * @Route("/{id}", name="admin_sender_update")
     * @Method("PUT")
     * @Template("ColizenAdminBundle:Sender:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColizenAdminBundle:Sender')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sender entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_sender_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Sender entity.
     *
     * @Route("/{id}", name="admin_sender_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ColizenAdminBundle:Sender')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Sender entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_sender_list'));
    }

    /**
     * Creates a form to delete a Sender entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_sender_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'regulzen.admin.delete','attr'=>array('type'=>'danger','icon'=>'trash')))
            ->getForm()
        ;
    }
}
