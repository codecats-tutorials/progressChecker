<?php

namespace CodeCats\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TechnologyController extends Controller
{
    public function indexAction()
    {
        return $this->render('CodeCatsFrontBundle:Technology:index.html.twig');
    }
}
