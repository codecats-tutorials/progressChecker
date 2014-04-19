<?php

namespace CodeCats\PanelBundle\Controller;

use CodeCats\PanelBundle\Form\LanguageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Parser;

class LanguageController extends Controller
{
    public function switchLanguageAction(Request $request, $locale, $flashMessage = true)
    {
      //  $request->setLocale($locale);
        $request->getSession()->set('_locale', $locale);
        $this->putCookie($locale);

        $path = $this->getPathBack($request);
        $router = $this->container->get('router');
        // Match route and get it's arguments
        $route = $router->match($path);

        if ($flashMessage === true) $this->get('session')->getFlashBag()->add('notice', 'language.changed');
        $this->saveMessagesToJson($locale);

        return new RedirectResponse($router->generate($route['_route']));
    }
    protected function putCookie($locale) {
        $cookie = new Cookie('language', $locale);
        $response = new Response();
        $response->headers->setCookie($cookie);

    }

    protected function getPathBack(Request $request)
    {
        $referer = $request->headers->get('referer');
        // Create URL path to pass it to matcher
        $urlParts = parse_url($referer);
        $basePath = $request->getBaseUrl();
        $path = str_replace($basePath, '', $urlParts['path']);

        return $path;
    }

    protected function saveMessagesToJson($locale)
    {
        $yaml = new Parser();
        $messages = $yaml->parse(file_get_contents(
                $this->get('kernel')->getRootDir() . '/Resources/translations/messages.' . $locale . '.yml')
        );
        $content = json_encode($messages);

        $path = $this->get('kernel')->locateResource('@CodeCatsPanelBundle/Resources/public/js/cache');
        $this->makeDirIfNotExists($path .= '/translations');
        file_put_contents("$path/messages.$locale.json", "I18n['$locale'] = $content");
    }

    protected function makeDirIfNotExists($path) {
        $fs = new Filesystem();
        if ( ! $fs->exists($path)) $fs->mkdir($path);

        return $this;
    }

}
