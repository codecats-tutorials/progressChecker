<?php

namespace CodeCats\PanelBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Parser;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
    	if ( ! $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
    	
    		return $this->redirect($this->generateUrl('login'));
    	}
        $filesystem = new Filesystem();
        $path = $this->get('kernel')->locateResource('@CodeCatsPanelBundle/Resources/public/js/cache/translations');
        if ( ! $filesystem->exists($path)) {
            $this->forward('CodeCatsPanelBundle:Language:switchLanguage', array('locale' => 'en'));
        }
        $user       = $this->container->get('security.context')->getToken()->getUser();
        $router     = $this->container->get('router')->getContext();
        $path       = $this->generateUrl('code_cats_panel_avatar_session_get');

        return $this->render('CodeCatsPanelBundle:Default:index.html.twig', array(
            'scripts'   => $this->getJsScripts(),
            'packages'  => $this->getJsonPackages(),
            'user'      => json_encode(array(
                'username'      => $user->getUsername(),
                'email'         => $user->getEmail(),
                'logoutUrl'     => $this->generateUrl('logout'),
                'locale'        => $request->getLocale(),
                'avatar'        => $path,
                'host'          => $router->getHost()
            ))
        ));
    }

    protected function getJsScripts()
    {
        $path = $this->get('kernel')->locateResource('@CodeCatsPanelBundle/Resources/public/js/panel');

        $objects = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path), \RecursiveIteratorIterator::SELF_FIRST
        );

        $scripts = [];
        foreach ($objects as $object) {
            if (substr($object, -3) === '.js' && substr($object, -7) !== 'main.js') {
                $scripts[] = preg_replace ('#^.+/js/panel#', '/js/panel', $object);
            }
        }

        return $scripts;
    }

    protected function getJsonPackages()
    {
        $filesystem = new Filesystem();
        $path = $this->get('kernel')->locateResource('@CodeCatsPanelBundle/Resources/public/js/cache');

        if ( ! $filesystem->exists($path)) throw new FileNotFoundException('Cache assets not found.');
        if ( ! $filesystem->exists($path)) throw new FileNotFoundException('Translations assets not found.');

        $objects = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path), \RecursiveIteratorIterator::SELF_FIRST
        );

        $messages = [];
        foreach ($objects as $object) {
            if (substr($object, -5) === '.json') {
                $messages[] = preg_replace ('#^.+/js/cache#', '/js/cache', $object);
            }
        }

        return $messages;
    }
}
