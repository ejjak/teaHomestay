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
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

    public function PackageViewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $em->getRepository('AppBundle:Packages')->find($id);
        if ($view instanceof Packages)
        {
            $id = $view->getId();
            $title = $view->getTitle();
            $body = $view->getDescription();
        }

//        dump($view);die;
        return $this->render('links/packages.html.twig', array(
            'id' => $id,
            'title' => $title,
            'description' => $body,

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

}