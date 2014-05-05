<?php

namespace CodeCats\PanelBundle\Controller;

use CodeCats\PanelBundle\Entity\Avatar;
use CodeCats\PanelBundle\Entity\Category;
use CodeCats\PanelBundle\Entity\Progress;
use CodeCats\PanelBundle\Form\AvatarType;
use CodeCats\PanelBundle\Form\UserAvatarType;
use CodeCats\PanelBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TestController extends Controller
{
    public function testAction(Request $request)
    {

        $em     = $this->getDoctrine()->getManager();
        $user   = $em->getRepository('CodeCatsPanelBundle:User')->find($this->get('security.context')->getToken()->getUser()->getId());

        $form = $this->createForm(new UserAvatarType(), $user);
        $form->add('submit', 'submit');
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($user);

            $em->flush();
        }

        return $this->render('CodeCatsPanelBundle:Test:test.html.twig', array(
            'form' => $form->createView(),
            //'form' => $this->createForm(new UserType(), $user)->createView(),
            'valid'=> $form->isValid()
        ));
    }

}
