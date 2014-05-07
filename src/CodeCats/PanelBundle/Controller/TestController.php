<?php

namespace CodeCats\PanelBundle\Controller;

use CodeCats\PanelBundle\Entity\Email;
use CodeCats\PanelBundle\Entity\User;
use CodeCats\PanelBundle\Form\EmailType;
use CodeCats\PanelBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TestController extends Controller
{
    public function testIdAction(Request $request, $id)
    {

        $em     = $this->getDoctrine()->getManager();
        $email  = $em->getRepository('CodeCatsPanelBundle:Email')->find($id);

        $form = $this->createForm(new EmailType(), $email, array('method' => 'PUT'));
        $form->add('submit', 'submit');
        $form->handleRequest($request);

        if ($form->isValid()) {

            //$em->flush();
        }

        return $this->render('CodeCatsPanelBundle:Test:test.html.twig', array(
            'form' => $form->createView(),
            //'form' => $this->createForm(new UserType(), $user)->createView(),
            'valid'=> $form->isValid()
        ));
    }

    public function testAction(Request $request)
    {

        $em     = $this->getDoctrine()->getManager();
        $email   = new Email();

        $form = $this->createForm(new EmailType(), $email, array('method' => 'PUT'));
        $form->add('submit', 'submit');
        $form->handleRequest($request);

        if ($form->isValid()) {


            //$em->flush();
        }

        return $this->render('CodeCatsPanelBundle:Test:test.html.twig', array(
            'form' => $form->createView(),
            //'form' => $this->createForm(new UserType(), $user)->createView(),
            'valid'=> $form->isValid()
        ));
    }

}
