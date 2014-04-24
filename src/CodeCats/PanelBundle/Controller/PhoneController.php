<?php

namespace CodeCats\PanelBundle\Controller;

use CodeCats\PanelBundle\Entity\Phone;
use CodeCats\PanelBundle\Form\PhoneType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PhoneController extends Controller
{
    public function getAction(Request $request)
    {
        $em     = $this->getDoctrine()->getManager();
        $user   = $em->getRepository('CodeCatsPanelBundle:Phone');
        $all    = $user->findAll();

        return new JsonResponse(array('success' => true, 'data' => $all));
    }

    public function updateAction(Request $request, $id)
    {
        $em         = $this->getDoctrine()->getManager();
        $factory    = Forms::createFormFactory();

        $phone      = $em->getRepository('CodeCatsPanelBundle:Phone')->find($id);
        $form       = $factory->createNamed(null, new PhoneType(), $phone, array('method' => 'PUT'));
        $data       = json_decode($request->getContent(), true);
        $form->submit($data);
        if ($form->isValid()) {
            $em->flush();

            return new JsonResponse(array('success' => true, 'id' => null));
        }

        return new JsonResponse(array('success' => false));
    }

    public function createAction(Request $request)
    {
        $em         = $this->getDoctrine()->getManager();
        $factory    = Forms::createFormFactory();

        $phone      = new Phone();
        $form       = $factory->createNamed(null, new PhoneType(), $phone);
        $data       = json_decode($request->getContent(), true);
        $form->submit($data);
        if ($form->isValid()) {
            $em->persist($phone);
            $em->flush();

            return new JsonResponse(array('success' => true, 'id' => null));
        }

        return new JsonResponse(array('success' => false));
    }

    public function deleteAction(Request $request, $id)
    {
        $em     = $this->getDoctrine()->getManager();
        $phone  = $em->getRepository('CodeCatsPanelBundle:Phone')->find($id);

        $em->remove($phone);
        $em->flush();
    }

}
