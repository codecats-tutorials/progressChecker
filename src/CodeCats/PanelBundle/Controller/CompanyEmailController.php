<?php

namespace CodeCats\PanelBundle\Controller;

use CodeCats\PanelBundle\Entity\Email;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CompanyEmailController extends Controller
{
    public function getAction()
    {
        $em     = $this->getDoctrine()->getManager();
        $user   = $this->get('security.context')->getToken()->getUser();

        return new JsonResponse(array('success' => true, 'data' => $user->getCompanyEmail()));
        $email->setUsername('jan@volswagen.pl');
        $user->setCompanyEmail($email);
        $email->addUser($user);
        $em->persist($email);
        $em->persist($user);
        $em->flush();
    }

    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
    }

    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
    }

    public function deleteAction()
    {
    }

}
