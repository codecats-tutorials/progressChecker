<?php

namespace CodeCats\TestBundle\Controller;

use CodeCats\PanelBundle\Entity\Progress;
use CodeCats\PanelBundle\Form\ProgressType;
use CodeCats\TestBundle\Entity\Test;
use CodeCats\TestBundle\Form\TestType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function renderAction(Request $request)
    {
        $valid = false;
        $test = new Test();

        $form = $this->createForm(new TestType(), $test, array('method' => 'PUT'))->add('submit', 'submit');

        $form->handleRequest($request);


        if ($form->isValid()) {
            $valid = true;
        }

        return $this->render('CodeCatsTestBundle:Default:render.html.twig', [
            'form' => $form->createView(),
            'valid' => $valid,
            'submited' => $form->isSubmitted(),
            'validatorErrors' => $form->getErrors(),
            'test' => $test
        ]);
    }
    public function indexAction($name, Request $request)
    {
        $fb = $this->get('fire_php');

        $em = $this->getDoctrine()->getManager();

        $test = new Test();
        $test->setName("Test");
        //$test->setStart();
        $form = $this->createForm(new TestType(), $test);

        $store = array(
            "name" => "Test",
            "start" => new \DateTime()
        );

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($test);
            $em->flush();
        } else var_dump($this->getErrorMessages($form));


        return $this->render('CodeCatsTestBundle:Default:index.html.twig', array('name' => $name));
    }
}
