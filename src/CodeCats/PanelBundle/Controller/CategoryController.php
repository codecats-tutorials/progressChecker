<?php

namespace CodeCats\PanelBundle\Controller;

use CodeCats\PanelBundle\Entity\Category;
use CodeCats\PanelBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Forms;
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
        $factory = Forms::createFormFactory();

        $category = new Category();
        $form = $factory->createNamed(null, new CategoryType(), $category);

        $form->submit(json_decode($request->getContent(), true));

        if ($form->isValid()) {
            $em->persist($category);
            $em->flush();

            return new JsonResponse(array('success' => true));
        }

        return new JsonResponse(array('success' => false, 'errors' => $form->getErrors()));
    }

    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $factory = Forms::createFormFactory();

        $category = $em->getRepository('CodeCatsPanelBundle:Category')->find($id);

        $form = $factory->createNamed(null, new CategoryType(), $category, array('method' => 'PUT'));
        $form->submit(json_decode($request->getContent(), true));

        if ($form->isValid()) {
            $em->flush();
        }

        return new JsonResponse(array('success' => false, 'errors' => $form->getErrors()));
    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('CodeCatsPanelBundle:Category')->find($id);

        $em->remove($category);
        $em->flush();

        return new JsonResponse(array('success' => true));
    }

}
