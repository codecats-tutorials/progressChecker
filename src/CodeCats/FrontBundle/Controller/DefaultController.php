<?php

namespace CodeCats\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em     = $this->getDoctrine()->getManager();
        $user   = $em->getRepository('CodeCatsPanelBundle:User');

        return $this->render('CodeCatsFrontBundle:Default:index.html.twig', array(
            'users' => $user->getMostActive(3)
        ));
    }
}
