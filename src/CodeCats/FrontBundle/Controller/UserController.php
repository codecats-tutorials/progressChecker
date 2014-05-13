<?php

namespace CodeCats\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $users      = $em->getRepository('CodeCatsPanelBundle:User');

        return $this->render('CodeCatsFrontBundle:User:index.html.twig', array(
            'mostActive'        => $users->findMostActive(3),
            'users'             => $users->findAll()
        ));
    }

    public function profileAction(Request $request, $id)
    {
        $user = $this->getDoctrine()->getManager()->getRepository('CodeCatsPanelBundle:User');

        return $this->render('CodeCatsFrontBundle:User:profile.html.twig', array(
            'user'          => $user->find($id),
            'progressTime'  => $user->findProgressTime($id, 3),
            'favorites'     => $user->findFavoriteCategory($id, 5)
        ));
    }
}
