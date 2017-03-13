<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Gallery;
use AppBundle\Entity\Images;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Gallery controller.
 *
 */
class GalleryController extends Controller
{
    /**
     * Lists all gallery entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $galleries = $em->getRepository('AppBundle:Gallery')->findAll();

        return $this->render('gallery/index.html.twig', array(
            'galleries' => $galleries,
        ));
    }

    /**
     * Creates a new gallery entity.
     *
     */
    public function newAction(Request $request)
    {

        $gallery = new Gallery();
        $form = $this->createForm('AppBundle\Form\GalleryType', $gallery);
        $form->add('submit',SubmitType::class,array('label'=> 'Create'));
        $gallery->setCreated(new \DateTime());
        $form->handleRequest($request);
//        dump($form);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($gallery);
            $em->flush();

            return $this->redirectToRoute('gallery_show', array('id' => $gallery->getId()));
        }

        return $this->render('gallery/new.html.twig', array(
            'gallery' => $gallery,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a gallery entity.
     *
     */
//    public function showAction(Gallery $gallery)
//    {
//        $deleteForm = $this->createDeleteForm($gallery);
//
//        return $this->render('gallery/show.html.twig', array(
//            'gallery' => $gallery,
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $detail = array();
        $gallery = $em->getRepository('AppBundle:Gallery')->find($id);
        $deleteForm = $this->createDeleteForm($gallery);
        if($gallery instanceof Gallery)
        {
            $titlename = $gallery->getTitleName();
            $imageDetail = $gallery->getImage();
            foreach($imageDetail as $val)
            {
                if ($val instanceof Images)
                {
                    $detail[] = array('path' => $val->getPath());
                }
            }
        }
//        dump($classimage);die;
        return $this->render('gallery/show.html.twig', array(
            'id' => $id,
            'titlename' => $titlename,
            'detail'      => $detail,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing gallery entity.
     *
     */
    public function editAction(Request $request, Gallery $gallery)
    {
        $deleteForm = $this->createDeleteForm($gallery);
        $editForm = $this->createForm('AppBundle\Form\GalleryType', $gallery);
        $gallery->setModified(new \DateTime());
        $editForm->add('submit',SubmitType::class,array('label'=> 'Update'));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gallery);
            $em->flush();
            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Page has been successfully updated !');

            return $this->redirectToRoute('gallery_edit', array('id' => $gallery->getId()));
        }

        return $this->render('gallery/edit.html.twig', array(
            'gallery' => $gallery,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a gallery entity.
     *
     */
    public function deleteAction(Request $request, Gallery $gallery)
    {
        $form = $this->createDeleteForm($gallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($gallery);
            $em->flush();
        }

        return $this->redirectToRoute('gallery_index');
    }

    /**
     * Creates a form to delete a gallery entity.
     *
     * @param Gallery $gallery The gallery entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Gallery $gallery)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('gallery_delete', array('id' => $gallery->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
