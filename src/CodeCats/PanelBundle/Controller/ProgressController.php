<?php

namespace CodeCats\PanelBundle\Controller;

use CodeCats\PanelBundle\CodeCatsPanelBundle;
use CodeCats\PanelBundle\Entity\Progress;
use CodeCats\PanelBundle\Form\ProgressType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use DateTime;

class ProgressController extends Controller
{
    public function getAction()
    {
        $em = $this->getDoctrine()->getManager();
        $progress = $em->getRepository('CodeCatsPanelBundle:Progress');
        $all = $progress->findAll();

        return new JsonResponse(array('success' => true, 'data' => $all));
    }

    public function updateAction(Request $request, $id)
    {
        $fb = $this->get('fire_php');
        $em = $this->getDoctrine()->getManager();
        $factory = Forms::createFormFactory();

        $progress = $em->getRepository('CodeCatsPanelBundle:Progress')->find($id);

        $form = $factory->createNamed(null, new ProgressType(), $progress, array('method'=>'PUT'));
        $form->submit(json_decode($request->getContent(), true));

        if ($form->isValid()) {
            $em->flush();

            return new JsonResponse(array('success' => true));
        }

        return new JsonResponse(array('success' => false, 'errors' => $form->getErrors()));
    }

    public function createAction(Request $request)
    {
        $fb = $this->get('fire_php');
        $em = $this->getDoctrine()->getManager();
        $progress = new Progress();

        $factory = Forms::createFormFactory();
        $form = $factory->createNamed(null, new ProgressType(), $progress);

        $form->handleRequest(null, $request);
        if ($form->isValid()) {
            $em->persist($progress);
            $em->flush();

            return new JsonResponse(array('success' => true));
        }

        return new JsonResponse(array('success' => false, 'errors' => $form->getErrors()));
    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $progress = $em->getRepository('CodeCatsPanelBundle:Progress')->find($id);

        $em->remove($progress);
        $em->flush();

        return new JsonResponse(array('success' => true));
    }
}
