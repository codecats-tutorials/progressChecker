<?php

namespace CodeCats\PanelBundle\Controller;

use CodeCats\PanelBundle\Entity\Progress;
use CodeCats\PanelBundle\Form\ProgressType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProgressController extends Controller
{
    public function getAction()
    {
//        $serializer = $this->container->get('serializer');
//        $reports = $serializer->serialize($doctrineobject, 'json');
//        return new Response($doctrineobject);

        return new JsonResponse(array('success' => true, 'data' => [['id' => null, 'title' => 'a']]));
    }

    public function putAction(Request $request)
    {

       // var_dump($request->query->all());

        $fb = $this->get('fire_php');



        $progress = new Progress();
        $form = $this->createForm(new ProgressType(), $progress);

        $form->setData(json_decode($request->getContent(), true));
$fb->log($form);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($progress);
            $em->flush();

            return new JsonResponse(array('success' => true));
        }

        return new JsonResponse(array('success' => false, 'errors' => $form->getErrors()));
    }

    public function deleteAction()
    {
        return new JsonResponse(array('success' => true, 'data' => [['id' => 666, 'title' => 'a']]));
    }

}
