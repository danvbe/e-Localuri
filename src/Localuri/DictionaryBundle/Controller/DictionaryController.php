<?php

namespace Localuri\DictionaryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Localuri\DictionaryBundle\Entity\Dictionary;
use Localuri\DictionaryBundle\Form\Type\DictionaryType;

/**
 * Dictionary controller.
 *
 */
class DictionaryController extends Controller
{
    /**
     * Lists all Dictionary entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LocaluriDictionaryBundle:Dictionary')->findAll();

        return $this->render('LocaluriDictionaryBundle:Dictionary:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Dictionary entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocaluriDictionaryBundle:Dictionary')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dictionary entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('LocaluriDictionaryBundle:Dictionary:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Dictionary entity.
     *
     */
    public function newAction()
    {
        $entity = new Dictionary();
        $form   = $this->createForm(new DictionaryType($this->get('dictionary_service')), $entity);

        return $this->render('LocaluriDictionaryBundle:Dictionary:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Dictionary entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Dictionary();
        $form   = $this->createForm(new DictionaryType($this->get('dictionary_service')), $entity);

        //we check to see if we have a class definition for this type of dictionary type
        //if so... we create corresponding entity
        $form_params = $request->request->get($form->getName());
        $em = $this->getDoctrine()->getManager();

        if ($form_params['type'] && $en = $em->getRepository('LocaluriDictionaryBundle:Dictionary')->find($form_params['type'])){
            $class_name = 'Localuri\DictionaryBundle\Entity\\'.$en->getDescription();
            if(class_exists(strtolower($class_name)))
                $entity = new $class_name();
        }

        $form = $this->createForm(new DictionaryType($this->get('dictionary_service')), $entity);

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_dictionary_show', array('id' => $entity->getId())));
        }

        return $this->render('LocaluriDictionaryBundle:Dictionary:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Dictionary entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocaluriDictionaryBundle:Dictionary')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dictionary entity.');
        }

        $editForm = $this->createForm(new DictionaryType($this->get('dictionary_service')), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('LocaluriDictionaryBundle:Dictionary:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Dictionary entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocaluriDictionaryBundle:Dictionary')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dictionary entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DictionaryType($this->get('dictionary_service')), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_dictionary_edit', array('id' => $id)));
        }

        return $this->render('LocaluriDictionaryBundle:Dictionary:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Dictionary entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LocaluriDictionaryBundle:Dictionary')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Dictionary entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_dictionary'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
