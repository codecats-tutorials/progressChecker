<?php

namespace CodeCats\PanelBundle\Controller;

use CodeCats\PanelBundle\Entity\Progress;
use CodeCats\PanelBundle\Form\ProgressType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class ProgressController extends Controller
{
    public function getAction()
    {
        $em = $this->getDoctrine()->getManager();
        $progress = $em->getRepository('CodeCatsPanelBundle:Progress');
        $all = $progress->findAll();
        $json = array();
        foreach ($all as $progress){
            array_push($json, array(
                'id' => $progress->getId(),
                'title' => $progress->getTitle()
            ));
        }

        return new JsonResponse(array('success' => true, 'data' => $json));
    }

    public function putAction(Request $request)
    {

        $fb = $this->get('fire_php');

        $progress = new Progress();
        $form = $this->createForm(new ProgressType(), $progress, array('method' => 'PUT'));
        $store = json_decode($request->getContent(), true);

        unset($store['started']);
        $form->submit($store);

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
