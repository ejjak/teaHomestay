<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Packages;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Package controller.
 *
 */
class PackagesController extends Controller
{
    /**
     * Lists all package entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $packages = $em->getRepository('AppBundle:Packages')->findAll();

        return $this->render('packages/index.html.twig', array(
            'packages' => $packages,
        ));
    }

    /**
     * Creates a new package entity.
     *
     */
    public function newAction(Request $request)
    {
        $package = new Packages();
        $form = $this->createForm('AppBundle\Form\PackagesType', $package);
        $package->setCreated(new \DateTime());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($package);
            $em->flush($package);

            return $this->redirectToRoute('packages_show', array('id' => $package->getId()));
        }

        return $this->render('packages/new.html.twig', array(
            'package' => $package,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a package entity.
     *
     */
    public function showAction(Packages $package)
    {
        $deleteForm = $this->createDeleteForm($package);

        return $this->render('packages/show.html.twig', array(
            'package' => $package,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing package entity.
     *
     */
    public function editAction(Request $request, Packages $package)
    {
        $deleteForm = $this->createDeleteForm($package);
        $editForm = $this->createForm('AppBundle\Form\PackagesType', $package);
        $package->setModified(new \DateTime());
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Page has been successfully updated !');

            return $this->redirectToRoute('packages_edit', array('id' => $package->getId()));
        }

        return $this->render('packages/edit.html.twig', array(
            'package' => $package,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a package entity.
     *
     */
    public function deleteAction(Request $request, Packages $package)
    {
        $form = $this->createDeleteForm($package);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($package);
            $em->flush();
        }

        return $this->redirectToRoute('packages_index');
    }

    /**
     * Creates a form to delete a package entity.
     *
     * @param Packages $package The package entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Packages $package)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('packages_delete', array('id' => $package->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
