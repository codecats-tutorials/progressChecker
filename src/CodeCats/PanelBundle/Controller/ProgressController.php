<?php

namespace CodeCats\PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProgressController extends Controller
{
    public function getAction()
    {
//        $serializer = $this->container->get('serializer');
//        $reports = $serializer->serialize($doctrineobject, 'json');
//        return new Response($doctrineobject);

        return new JsonResponse(array('success' => true, 'data' => [['id' => 4, 'title' => 'a']]));
    }

    public function putAction()
    {

    }

    public function deleteAction()
    {
        return new JsonResponse(array('success' => true, 'data' => [['id' => 666, 'title' => 'a']]));
    }

}
