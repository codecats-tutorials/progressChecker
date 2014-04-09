<?php

namespace CodeCats\TestBundle\Controller;

use CodeCats\TestBundle\Entity\Test;
use CodeCats\TestBundle\Form\TestType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
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

        $form->submit($store);

        if ($form->isValid()) {
            $em->persist($test);
            $em->flush();
        } else var_dump($this->getErrorMessages($form));


        return $this->render('CodeCatsTestBundle:Default:index.html.twig', array('name' => $name));
    }
    private function getErrorMessages(\Symfony\Component\Form\Form $form) {
        $errors = array();

        foreach ($form->getErrors() as $key => $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = $this->getErrorMessages($child);
            }
        }

        return $errors;
    }
}
