<?php
/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 06-Mar-17
 * Time: 6:10 PM
 */
namespace AppBundle\Controller;
use Proxies\__CG__\AppBundle\Entity\Pages;
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

}