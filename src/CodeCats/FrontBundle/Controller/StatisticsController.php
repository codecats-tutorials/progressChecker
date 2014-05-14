<?php

namespace CodeCats\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StatisticsController extends Controller
{
    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $progress   = $em->getRepository('CodeCatsPanelBundle:Progress');
        $category   = $em->getRepository('CodeCatsPanelBundle:Category');
        $user       = $em->getRepository('CodeCatsPanelBundle:User');

        return $this->render('CodeCatsFrontBundle:Statistics:index.html.twig', array(
            'progressStrike'=> $progress->findLongestStrike(),
            'countDays'     => $progress->countDays(),
            'categoryMostUsed' => $category->findMostUsed(),
            'categories'    => $category->findAll(),
            'users'         => $user->findMostActive(3)
        ));
    }
}
