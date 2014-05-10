<?php

namespace CodeCats\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em     = $this->getDoctrine()->getManager();
        $user   = $em->getRepository('CodeCatsPanelBundle:User');

//        var_dump();
        $items = $user->getMostActive();

//        foreach ($items as $item) {
//            var_dump($item);
//        }
var_dump($items);
        return $this->render('CodeCatsFrontBundle:Default:index.html.twig');
    }
}
