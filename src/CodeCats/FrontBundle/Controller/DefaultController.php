<?php

namespace CodeCats\FrontBundle\Controller;

use CodeCats\PanelBundle\Entity\Progress;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $user       = $em->getRepository('CodeCatsPanelBundle:User');
        $category   = $em->getRepository('CodeCatsPanelBundle:Category');
        $progress   = $em->getRepository('CodeCatsPanelBundle:Progress');


        return $this->render('CodeCatsFrontBundle:Default:index.html.twig', array(
            'users'         => $user->getMostActive(3),
            'categories'    => $category->findAll(),
            'progresses'    => $progress->findBy(array(), array('ended' => 'DESC'), 5)
        ));
    }
}
