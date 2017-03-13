<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Pages;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Page controller.
 *
 */
class PagesController extends Controller
{
    /**
     * Lists all page entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pages = $em->getRepository('AppBundle:Pages')->findAll();

        return $this->render('pages/index.html.twig', array(
            'pages' => $pages,
        ));
    }

    /**
     * Creates a new page entity.
     *
     */
    public function newAction(Request $request)
    {
        $page = new Pages();
        $form = $this->createForm('AppBundle\Form\PagesType', $page);
        $page->setCreated(new \DateTime());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush($page);

            return $this->redirectToRoute('pages_show', array('id' => $page->getId()));
        }

        return $this->render('pages/new.html.twig', array(
            'page' => $page,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a page entity.
     *
     */
    public function showAction(Pages $page)
    {
        $deleteForm = $this->createDeleteForm($page);

        return $this->render('pages/show.html.twig', array(
            'page' => $page,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing page entity.
     *
     */
    public function editAction(Request $request, Pages $page)
    {
        $deleteForm = $this->createDeleteForm($page);
        $editForm = $this->createForm('AppBundle\Form\PagesType', $page);
        $page->setModified(new \DateTime());
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pages_edit', array('id' => $page->getId()));
        }

        return $this->render('pages/edit.html.twig', array(
            'page' => $page,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a page entity.
     *
     */
    public function deleteAction(Request $request, Pages $page)
    {
        $form = $this->createDeleteForm($page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($page);
            $em->flush($page);
        }

        return $this->redirectToRoute('pages_index');
    }

    /**
     * Creates a form to delete a page entity.
     *
     * @param Pages $page The page entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pages $page)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pages_delete', array('id' => $page->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
