<?php
/**
 * Created by PhpStorm.
 * User: t
 * Date: 8/13/14
 * Time: 10:46 AM
 */

namespace CodeCats\CoreBundle\Service;


use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Kernel;

class FrontendAutoloader {


    protected $kernel;
    protected $fp;

    public function __construct(Kernel $kernel, \FirePHP $firePhp)
    {
        $this->kernel = $kernel;
        $this->fp = $firePhp;
    }

    /**
     * Server site loader for scripts:
     * @return array
     */
    public function getJsScripts()
    {
        $path = $this->kernel->locateResource('@CodeCatsCoreBundle/Resources/public/js/ext/app');
        $objects = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST
        );
        $scripts = array();

        foreach ($objects as $object) {
            $this->fp->log($object);
            if (substr($object, -3) === '.js' && substr($object, -7) !== 'main.js') {

                $scripts[] = preg_replace ('#^.+/js/ext#', '/js/ext', $object);
            }
        }
        asort($scripts);


        return $scripts;
    }

    /**
     * @return array
     * @throws FileNotFoundException
     */
    public function getJsonPackages()
    {
        $filesystem = new Filesystem();
        $path = $this->kernel->locateResource('@CodeCatsCoreBundle/Resources/public/js/cache');
        if ( ! $filesystem->exists($path)) throw new FileNotFoundException('Cache assets not found.');
        if ( ! $filesystem->exists($path)) throw new FileNotFoundException('Translations assets not found.');
        $objects = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST
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