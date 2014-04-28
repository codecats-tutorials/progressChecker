<?php

namespace CodeCats\PanelBundle\Controller;

use CodeCats\PanelBundle\Entity\Category;
use CodeCats\PanelBundle\Entity\Progress;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class TestController extends Controller
{
    public function testAction()
    {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('CodeCatsPanelBundle:User');

        $all = $user->find(1);
        $allJson = [];
        foreach($all->getPhones() as $phone) {
            $allJson[] = $phone;
        }
        echo new JsonResponse($allJson);
        $phone = $em->getRepository('CodeCatsPanelBundle:Phone');
        $all = $phone->find(2);

        foreach($all->getUsers() as $user) {
            var_dump($user->getUsername());
        }
//        var_dump($all->getPhones());


//        $em = $this->getDoctrine()->getManager();
//
//        $category = $em->getRepository('CodeCatsPanelBundle:Category')->find(1);
//        var_dump($category->getProgresses()[0]);


//        $category = new Category();
//        $progress = new Progress();
//        $category->setName('C++');
//        $progress->setTitle('Praca');
//        $category->addProgress($progress);
//        $progress->setCategory($category);
//
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($category);
//        $em->persist($progress);
//
//
//        $em->flush();



        return $this->render('CodeCatsPanelBundle:Test:test.html.twig');
    }

}
