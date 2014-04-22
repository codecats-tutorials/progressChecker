<?php

namespace CodeCats\PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    public function getAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('CodeCatsPanelBundle:Category');
        $all = $category->findAll();

        return new JsonResponse(array('success' => true, 'data' => $all));
    }

    public function createAction(Request $request)
    {
        $fb = $this->get('fire_php');
        $em = $this->getDoctrine()->getManager();
    }

    public function updateAction()
    {
    }

    public function deleteAction()
    {
    }

}
