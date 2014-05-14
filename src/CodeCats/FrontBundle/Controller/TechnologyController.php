<?php

namespace CodeCats\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TechnologyController extends Controller
{
    public function indexAction()
    {
        $em             = $this->getDoctrine()->getManager();
        $technology     = $em->getRepository('CodeCatsPanelBundle:Category');

        return $this->render('CodeCatsFrontBundle:Technology:index.html.twig', array(
            'technologies'      => $technology->findAll(),
            'mostUsed'          => $technology->findMostUsed()
        ));
    }

    public function showAction(Request $request, $id)
    {
        $em             = $this->getDoctrine()->getManager();
        $technology     = $em->getRepository('CodeCatsPanelBundle:Category')->find($id);

        return $this->render('CodeCatsFrontBundle:Technology:show.html.twig', array(
            'category' => $technology
        ));
    }
}
