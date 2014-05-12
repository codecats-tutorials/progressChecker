<?php

namespace CodeCats\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StatisticsController extends Controller
{
    public function indexAction()
    {
        return $this->render('CodeCatsFrontBundle:Statistics:index.html.twig');
    }
}
