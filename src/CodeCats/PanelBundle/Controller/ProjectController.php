<?php

namespace CodeCats\PanelBundle\Controller;

use CodeCats\PanelBundle\Entity\Project;
use CodeCats\PanelBundle\Form\ProjectType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProjectController extends Controller
{
    public function getAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('CodeCatsPanelBundle:Project');
        $all = $project->findAll();

        return new JsonResponse(array('success' => true, 'data' => $all));
    }

    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $factory = Forms::createFormFactory();

        $project = new Project();
        $form = $factory->createNamed(null, new ProjectType(), $project);

        $form->submit(json_decode($request->getContent(), true));

        if ($form->isValid()) {
            $em->persist($project);
            $em->flush();

            return new JsonResponse(array('success' => true, 'id' => $project->getId()));
        }

        return new JsonResponse(array('success' => false, 'errors' => $form->getErrors()));
    }

    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $factory = Forms::createFormFactory();

        $project = $em->getRepository('CodeCatsPanelBundle:Project')->find($id);

        $form = $factory->createNamed(null, new ProjectType(), $project, array('method' => 'PUT'));
        $form->submit(json_decode($request->getContent(), true));

        if ($form->isValid()) {
            $em->flush();

            return new JsonResponse(array('success' => true, 'id' => null));
        }

        return new JsonResponse(array('success' => false, 'errors' => $form->getErrors()));
    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('CodeCatsPanelBundle:Project')->find($id);

        $em->remove($project);
        $em->flush();

        return new JsonResponse(array('success' => true));
    }

}
