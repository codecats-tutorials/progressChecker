<?php

namespace CodeCats\PanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
    	if ( ! $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
    	
    		return $this->redirect($this->generateUrl('login'));
    	}
        $user = $this->container->get('security.context')->getToken()->getUser();

        return $this->render('CodeCatsPanelBundle:Default:index.html.twig', array(
            'scripts'   => $this->getJsScripts(),
            'user'      => json_encode(array(
                'username'      => $user->getUsername(),
                'email'         => $user->getEmail(),
                'logoutUrl'     => $this->generateUrl('logout'),
                'locale'        => $request->getLocale()
            ))
        ));
    }

    protected function getJsScripts() {
        $kernel = $this->container->get('kernel');
        $arrBundles = $kernel->getBundles();
        $path = $arrBundles['CodeCatsPanelBundle']->getPath();
        $path .= '/Resources/public/js/panel';

        $objects = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        $scripts = [];
        foreach ($objects as $object) {
            if (substr($object, -3) === '.js' && substr($object, -7) !== 'main.js') {
                $scripts[] = preg_replace ('@^.+/js/panel@', '/js/panel', $object);
            }
        }

        return $scripts;
    }
}
