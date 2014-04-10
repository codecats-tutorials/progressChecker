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
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use DateTime;

class ProgressController extends Controller
{
    public function formAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

      ///  $progress = $em->getRepository('CodeCatsPanelBundle:Progress')->find(5);
        $progress = new Progress();
        $form = $this->createForm(new ProgressType(), $progress);

        $store = array(
            'title' => 'aa',
            'ended' => new DateTime()
        );
        $form->submit($store);

        if ($form->isValid()) {
            //$progress->setStarted(new DateTime());
        //    $em->flush();

            return new JsonResponse(array('success' => true));
        }
        var_export($this->getErrorMessages($form));

        return new JsonResponse(($this->getErrorMessages($form)));

    }
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

        $progress = $em->getRepository('CodeCatsPanelBundle:Progress')->find($id);
        $fb->log($progress);
        $form = $this->createForm(new ProgressType(), $progress);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return new JsonResponse(array('success' => true));
        }

        return new JsonResponse(array('success' => false, 'errors' => $this->getErrorMessages($form)));
    }

    public function createAction(Request $request)
    {
        $fb = $this->get('fire_php');

        $progress = new Progress();
        $form = $this->createForm(new ProgressType(), $progress, array('method' => 'PUT'));
        $store = json_decode($request->getContent(), true);


        unset($store['id']);
        unset($store['started']);
       // $form->submit($store);
        $form->handleRequest($request);

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
