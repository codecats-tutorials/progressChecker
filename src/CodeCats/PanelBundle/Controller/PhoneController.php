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
    public function getByUserAction(Request $request)
    {
        $fb     = $this->get('fire_php');
        $em     = $this->getDoctrine()->getManager();
        $user   = $em->getRepository('CodeCatsPanelBundle:User')->find($this->get('security.context')->getToken()->getUser()->getId());

        foreach($user->getPhones() as $phone) {
            $all[] = $phone;
        }

        return new JsonResponse(array('success' => true, 'data' => $all));
    }

    public function getAction(Request $request)
    {
        $em     = $this->getDoctrine()->getManager();
        $phone  = $em->getRepository('CodeCatsPanelBundle:Phone');
        $all    = $phone->findAll();

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
            if ( ! empty($data['user_id'])) {
                $phone->addUser($em->getRepository('CodeCatsPanelBundle:User')->find($data['user_id']));
            }
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
            if ( ! empty($data['user_id'])) {
                $user = $em->getRepository('CodeCatsPanelBundle:User')->find($data['user_id']);
                $phone->addUser($user);
                $user->addPhone($phone);
            }
            $em->persist($phone);
            $em->persist($user);
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
