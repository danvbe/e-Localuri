<?php

namespace Localuri\LogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Localuri\LogBundle\Entity\Log;

/**
 * User controller.
 *
 */
class LogController extends Controller
{
    /////////////////////////ADMIN actions//////////////////////////////////////////////
    /**
     * Lists all User entities.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Controller\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LocaluriLogBundle:Log')->findAll();

        return $this->render('LocaluriLogBundle:Log:backend/index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a User entity.
     * @param $id the id of the user
     * @return \Symfony\Bundle\FrameworkBundle\Controller\Response
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocaluriLogBundle:Log')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find backend entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('LocaluriLogBundle:Log:backend/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Deletes a User entity.
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param $id
     * @return \Symfony\Bundle\FrameworkBundle\Controller\RedirectResponse
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LocaluriLogBundle:Log')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find backend entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('lcl_log_admin'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
