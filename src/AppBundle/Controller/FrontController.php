<?php
/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 06-Mar-17
 * Time: 6:10 PM
 */
namespace AppBundle\Controller;
use AppBundle\Entity\Contact;
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
            $title = $view->getTitle();
            $body = $view->getDescription();
        }

//        dump($view);die;
        return $this->render('pages/view.html.twig', array(
            'id' => $id,
            'title' => $title,
            'description' => $body,

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

        return $this->render('contact/contact.html.twig', array(
            'id'=> $id,
            'phone' => $phone,
            'landline' => $landline,
            'email' => $email,
            'address' => $address
        ));
    }

}