<?php
/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 06-Mar-17
 * Time: 6:10 PM
 */
namespace AppBundle\Controller;
use AppBundle\Entity\Contact;
use AppBundle\Entity\Gallery;
use AppBundle\Entity\Images;
use AppBundle\Entity\Packages;
use AppBundle\Entity\Pages;
use AppBundle\Entity\Reviews;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FrontController extends Controller
{
    public function PageViewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $em->getRepository('AppBundle:Pages')->find($id);
        if ($view instanceof Pages)
        {
            $id = $view->getId();
            $title = $view->getTitle();
            $body = $view->getDescription();
        }

//        dump($view);die;
        return $this->render('links/pages.html.twig', array(
            'id' => $id,
            'title' => $title,
            'description' => $body,

        ));
    }

    public function HomeAboutViewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $em->getRepository('AppBundle:Pages')->find($id);
        if ($view instanceof Pages)
        {
            $id = $view->getId();
            $title = $view->getTitle();
            $body = $view->getDescription();
        }

//        dump($view);die;
        return $this->render('links/home-about.html.twig', array(
            'id' => $id,
            'title' => $title,
            'description' => $body,

        ));
    }

    public function HomeWhyViewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $em->getRepository('AppBundle:Pages')->find($id);
        if ($view instanceof Pages)
        {
            $id = $view->getId();
            $title = $view->getTitle();
            $body = $view->getDescription();
        }

//        dump($view);die;
        return $this->render('links/home-why.html.twig', array(
            'id' => $id,
            'title' => $title,
            'description' => $body,

        ));
    }

    public function PackageViewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $em->getRepository('AppBundle:Packages')->find($id);
//        foreach($view as $var){
            if ($view instanceof Packages)
            {
                $id = $view->getId();
                $title = $view->getTitle();
                $img = $view->getImageurl();
                $body = $view->getDescription();

//                $detail[]= array('id'=>$id, 'title'=>$title, 'description'=>$body);
            }
//        }


//        dump($detail);die;
        return $this->render('links/packages.html.twig', array(
            'id'=>$id,
            'title' => $title,
            'image' => $img,
            'description'=>$body

        ));
    }

    public function ReviewsScrollAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Reviews');
        $query = $repository->createQueryBuilder('p')
            ->select('p.name as name','p.lastname as lastname','p.review as review', 'p.address as address','p.action as action')
            ->where('p.action = :action')
            ->setParameter('action', 1)
            ->setMaxResults(4)
            ->orderBy('p.id','DESC')
            ->getQuery()->getScalarResult()
            ;
//        foreach($view as $var){
//            if ($var instanceof Reviews)
//            {
//                $id = $var->getId();
//                $review = $var->getReview();
//                $name = $var->getName();
//                $lastname = $var->getLastname();
//                $address = $var->getAddress();
//
//                $detail[]= array('id'=>$id, 'review'=>$review, 'name'=>$name, 'lastname'=>$lastname, 'address'=>$address);
//            }
//        }


//        dump($query);die;
        return $this->render('links/review-scroll.html.twig', array(
            'detail' => $query

        ));
    }

    public function ReviewsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $view = $em->getRepository('AppBundle:Reviews')->findBy(array(),array('id' => 'DESC'));
        foreach($view as $var){
            if ($var instanceof Reviews)
            {
                $id = $var->getId();
                $name = $var->getName();
                $latname = $var->getLastname();
                $address = $var->getAddress();
                $review = $var->getReview();
                $action = $var->getAction();

                $detail[]= array('id'=>$id, 'name'=>$name, 'lastname'=>$latname, 'address'=> $address, 'review'=>$review, 'action'=>$action);
            }
        }


//        dump($detail);die;
        return $this->render('links/reviews.html.twig', array(
            'detail' => $detail

        ));
    }

    public function reviewNewAction(Request $request)
    {
        $review = new Reviews();
        $form = $this->createForm('AppBundle\Form\ReviewsType', $review);
        $review->setCreated(new \DateTime());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush($review);
            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Thank you for your review.');
//            return $this->redirectToRoute('tea_homestay_reviews', array('id' => $review->getId()));
        }

        return $this->render('links/write-review.html.twig', array(
            'review' => $review,
            'form' => $form->createView(),
        ));

    }

    public function GalleryShowAction()
    {

        $em = $this->getDoctrine()->getManager();
        $response = array();
        $gallery = $em->getRepository('AppBundle:Gallery')->findAll();

        foreach($gallery as $value)
        {
            if($value instanceof  Gallery)
            {
                $imageDetail= $value->getImage();
                $modified= $value->getModified();
                $detail = array();
                foreach ($imageDetail as $val) {
                    if ($val instanceof Images) {
                        $detail[] = $val->getPath();
                    }
                }
                $response[] = array('title' => $value->getTitleName(),'images' => $detail, 'modified'=>$modified);
            }
        }
//      dump($response);die;
        return $this->render('links/gallery.html.twig', array(
            'response'      => $response
        ));
    }

    public function ContactAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $em->getRepository('AppBundle:Contact')->find($id);
        if($view instanceof Contact){
            $phone = $view->getPhone();
            $landline = $view->getLandline();
            $email = $view->getEmail();
            $address = $view->getAddress();
        }

//        dump($view);die;

        return $this->render('links/contact.html.twig', array(
            'id'=> $id,
            'phone' => $phone,
            'landline' => $landline,
            'email' => $email,
            'address' => $address
        ));
    }


    public function PackagesListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $view = $em->getRepository('AppBundle:Packages')->findBy(array(),array('id' => 'DESC'));
        foreach($view as $var){
            if ($var instanceof Packages)
            {
                $id = $var->getId();
                $title = $var->getTitle();
                $img = $var->getImageurl();

                $detail[]= array('id'=>$id, 'title'=>$title, 'image' => $img);
            }
        }


//        dump($detail);die;
        return $this->render('links/package-list.html.twig', array(
            'detail' => $detail

        ));
    }

    public function PackagesListHomeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $view = $em->getRepository('AppBundle:Packages')->findBy(array(),array('id' => 'DESC'));
        foreach($view as $var){
            if ($var instanceof Packages)
            {
                $id = $var->getId();
                $title = $var->getTitle();

                $detail[]= array('id'=>$id, 'title'=>$title);
            }
        }


//        dump($detail);die;
        return $this->render('links/package-list-home.html.twig', array(
            'detail' => $detail

        ));
    }

}