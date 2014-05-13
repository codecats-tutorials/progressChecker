<?php

namespace CodeCats\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function indexAction()
    {
        return $this->render('CodeCatsFrontBundle:User:index.html.twig');
    }

    public function profileAction(Request $request, $id)
    {
        $user = $this->getDoctrine()->getManager()->getRepository('CodeCatsPanelBundle:User');

        return $this->render('CodeCatsFrontBundle:User:profile.html.twig', array(
            'user'          => $user->find($id),
            'progressTime'  => $user->findProgressTime($id),
            'favorite'      => $user->findFavoriteCategory($id)
        ));
    }
}
