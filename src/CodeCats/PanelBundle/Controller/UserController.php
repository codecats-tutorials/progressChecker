<?php

namespace CodeCats\PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CodeCats\PanelBundle\Entity\User;
use CodeCats\PanelBundle\Form\LoginType;
use CodeCats\PanelBundle\Form\Model\Login;
use Symfony\Component\Security\Core\SecurityContext;

class UserController extends Controller
{
	public function loginAction() 
	{
		$form = $this->createForm(new LoginType(), new Login());
		$request = $this->getRequest();
		$session = $request->getSession();
		
		if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
			$error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
		} else {
			$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
			$session->remove(SecurityContext::AUTHENTICATION_ERROR);
		}
		 
		
		return $this->render(
				'CodeCatsPanelBundle:User:login.html.twig',
				array(
						'form'      => $form->createView(),
						'error'     => $error
				)
		);
	}

    public function logoutAction()
    {
        $this->get('security.context')->setToken(null);
        $this->get('request')->getSession()->invalidate();

        return $this->redirect($this->generateUrl('login'));
    }
}
