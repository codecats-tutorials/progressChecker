<?php

namespace CodeCats\UserBundle\Controller;

use CodeCats\UserBundle\Form\LoginType;
use CodeCats\UserBundle\Form\Model\Login;
use CodeCats\UserBundle\Form\Model\Registration;
use CodeCats\UserBundle\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\CssSelector\Parser\Parser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    public function getAction(Request $request)
    {
        $em     = $this->getDoctrine()->getManager();
        $user   = $em->getRepository('CodeCatsUserBundle:User');
        $id     = $request->get('id');
        if (empty($id)) {
            $all = $user->findAll();
        } else {
            $all = $user->find($request->get('id'));
        }

        return new JsonResponse(array('success' => true, 'data' => $all));
    }
    public function updateAction(Request $request)
    {
        $em     = $this->getDoctrine()->getManager();
        $user   = $em->getRepository('CodeCatsUserBundle:User')->find($this->get('security.context')->getToken()->getUser()->getId());

        $form = $this->createForm(new UserAvatarType(), $user);
        $form->add('submit', 'submit');
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($user);

            $em->flush();
        }

        return new JsonResponse(array('success' => true));
    }

    public function loginAction(Request $request)
    {
        if ($this->get('security.context')->isGranted('ROLE_USER')) {

            return $this->redirect($this->generateUrl('code_cats_core_homepage'));
        }
        $yaml = new Parser();
        $messages = array('messages' => array());
        $configLanguages = $this->get('kernel')->getRootDir() . '/config/languages.yml';
        if (file_exists($configLanguages)) {
            $messages = $yaml->parse(file_get_contents($configLanguages));
        }

        $form = $this->createForm(new LoginType(), new Login());

        $session = $request->getSession();
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        $form->get('login')->setData($session->get(SecurityContext::LAST_USERNAME));

        return $this->render('CodeCatsUserBundle:Default:login.html.twig', array(
            'form'          => $form->createView(),
            'error'         => $error,
            'languages'     => $messages['messages']
        ));
    }

    public function logoutAction(Request $request)
    {
        $locale = $request->getLocale();

        $this->get('security.context')->setToken(null);
        $this->get('request')->getSession()->invalidate();


        $this->forward('CodeCatsUserBundle:Language:switchLanguage', array(
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

        return $this->render('CodeCatsUserBundle:Default:register.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
