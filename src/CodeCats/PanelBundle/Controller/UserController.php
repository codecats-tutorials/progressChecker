<?php

namespace CodeCats\PanelBundle\Controller;

use CodeCats\PanelBundle\Form\LanguageType;
use CodeCats\PanelBundle\Form\Model\Registration;
use CodeCats\PanelBundle\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CodeCats\PanelBundle\Entity\User;
use CodeCats\PanelBundle\Form\LoginType;
use CodeCats\PanelBundle\Form\Model\Login;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Yaml;

class UserController extends Controller
{
	public function loginAction(Request $request)
	{
        if ($this->get('security.context')->isGranted('ROLE_USER')) {

            return $this->redirect($this->generateUrl('code_cats_panel_homepage'));
        }
        $yaml = new Parser();
        $messages = $yaml->parse(file_get_contents($this->get('kernel')->getRootDir() . '/config/languages.yml'));

		$form = $this->createForm(new LoginType(), new Login());

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
						'form'          => $form->createView(),
						'error'         => $error,
                        'languages'     => $messages['messages']
				)
		);
	}

    public function logoutAction(Request $request)
    {
        $locale = $request->getLocale();

        $this->get('security.context')->setToken(null);
        $this->get('request')->getSession()->invalidate();


        $this->forward('CodeCatsPanelBundle:Language:switchLanguage', array(
            'locale'        => $locale,
            'flashMessage'  => false
        ));
        $this->get('session')->getFlashBag()->add('notice', $this->get('translator')->trans('logout.correct'));

        return $this->redirect($this->generateUrl('login'));
    }

    public function registerAction(Request $request)
    {
        $form = $this->createForm(new RegistrationType(), new Registration());
        $form->add($this->get('translator')->trans('login.submit'), 'submit');

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $registration = $form->getData();
            $user = $registration->getUser();

            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('login'));
        }

        return $this->render(
            'CodeCatsPanelBundle:User:register.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }
}
