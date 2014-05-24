<?php

namespace CodeCats\PanelBundle\Controller;

use CodeCats\PanelBundle\Entity\Email;
use CodeCats\PanelBundle\Entity\Progress;
use CodeCats\PanelBundle\Entity\User;
use CodeCats\PanelBundle\Form\EmailType;
use CodeCats\PanelBundle\Form\ProgressType;
use CodeCats\PanelBundle\Form\Type\ExtjsTimeType;
use CodeCats\PanelBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Acl\Exception\Exception;

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
//        $this->container->get('extjs_time');

//        $a = new ExtjsTimeType(null);
        $em     = $this->getDoctrine()->getManager();
        $ent   = new Progress();
        $factory = Forms::createFormFactory();

        //$form = $this->createForm(new ProgressType(), $ent, array('method' => 'PUT'));
        $form       = $factory->createNamed(null, new ProgressType(), $ent);
        $form->add('submit', 'submit');
        $form->handleRequest(null, $request);

        if ($form->isValid()) {

//            $em->persist($ent);
//            $em->flush();
        }

        return $this->render('CodeCatsPanelBundle:Test:test.html.twig', array(
            'form' => $form->createView(),
            //'form' => $this->createForm(new UserType(), $user)->createView(),
            'valid'=> $form->isValid(),
            'entity' => $ent
        ));
    }

}
