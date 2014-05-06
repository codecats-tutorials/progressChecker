<?php

namespace CodeCats\PanelBundle\Controller;

use CodeCats\PanelBundle\Entity\Email;
use CodeCats\PanelBundle\Form\EmailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CompanyEmailController extends Controller
{
    public function getAction()
    {
        $em     = $this->getDoctrine()->getManager();
        $id     = $this->get('security.context')->getToken()->getUser()->getId();
        $user   = $em->getRepository('CodeCatsPanelBundle:User')->find($id);

        return new JsonResponse(array('success' => true, 'data' => $user->getCompanyEmail()));
    }

    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
    }

    public function createAction(Request $request)
    {
        $fb = $this->get('fire_php');
        $em     = $this->getDoctrine()->getManager();
        $email  = new Email();
        $form   = $this->createForm(new EmailType(), $email);

        $fb->log($form->isValid());
        $fb->log($form->getErrorsAsString());
        $form->handleRequest($request);
        if ($form->isValid()) {

            $user = $this->get('security.context')->getToken()->getUser();
            $user->setCompanyEmail($email);
            $email->addUser($user);
            $em->persist($email);
            $em->persist($user);

            $em->flush();
        }

        return new JsonResponse(array('success' => true, 'id' => $email->getId()));
    }

    public function deleteAction()
    {
    }

}
