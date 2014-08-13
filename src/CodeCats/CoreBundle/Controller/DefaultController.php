<?php

namespace CodeCats\CoreBundle\Controller;

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
        $path = $this->get('kernel')->locateResource('@CodeCatsCoreBundle/Resources/public/js/cache/translations');
        if ( ! $filesystem->exists($path)) {
            $this->forward('CodeCatsCoreBundle:Language:switchLanguage', array('locale' => 'en'));
        }
        $user = $this->container->get('security.context')->getToken()->getUser();
        $router = $this->container->get('router')->getContext();
        $frontendLoader = $this->container->get('code_cats_core.frontend_autoloader');
        //$path = $this->generateUrl('code_cats_core_avatar_session_get');
        return $this->render('CodeCatsCoreBundle:Default:index.html.twig', array(
            'scripts' => $frontendLoader->getJsScripts(),
            'packages' => $frontendLoader->getJsonPackages(),
            'user' => json_encode(array(
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'logoutUrl' => $this->generateUrl('logout'),
                'locale' => $request->getLocale(),
                //'avatar' => $path,
                'host' => $router->getHost()
            ))
        ));
    }
}