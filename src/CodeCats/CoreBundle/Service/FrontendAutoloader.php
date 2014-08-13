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
use Symfony\Component\Yaml\Parser;

class FrontendAutoloader {


    protected $kernel;
    protected $fp;
    protected $yamlParser;

    public function __construct(Kernel $kernel, \FirePHP $firePhp)
    {
        $this->kernel = $kernel;
        $this->fp = $firePhp;
        $this->yamlParser = new Parser();
    }

    /**
     * Server site loader for scripts:
     * @return array
     */
    public function getJsScripts($path = null)
    {
        if ($path === null) {
            $path = $this->kernel->locateResource('@CodeCatsCoreBundle/Resources/public/js/ext/app');
        }
        $objects = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST
        );
        $scripts = $mappedScripts = array();

        foreach ($objects as $object) {
            if (substr($object,  -8) === 'load.yml') {
                $mappedScripts = $this->loadMap($object, $mappedScripts);
            }

            if (substr($object, -3) === '.js' && substr($object, -7) !== 'main.js') {
                $path = $this->getWebPath($object);
                if ( ! in_array($path, $scripts)) {
                    $scripts[] = $path;
                }
            }
        }
        asort($scripts);

//        $this->fp->log('all:');
//        $this->fp->log($mappedScripts);
//        $this->fp->log($scripts);
//        $this->fp->log(array_merge($scripts, $mappedScripts));
        return array_unique(array_merge($scripts, $mappedScripts));
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

    /* TODO: override value, not merge
     */
    protected function loadMap($ymlPath, $bin)
    {
        $raisedBin = array();
        $structure = $this->yamlParser->parse(file_get_contents($ymlPath));
        ksort($structure);

        foreach ($structure as $key => $map) {
            $path = dirname($ymlPath) . '/' . $map;
            if (is_dir($path)) {
                //$this->fp->log($raisedBin);
                //$this->fp->log($this->getJsScripts($path));
                $raisedBin = $this->overrideIfExist($this->getJsScripts($path), $raisedBin);//array_merge($raisedBin, $this->getJsScripts($path));
            } elseif (is_file($path)) {
                $raisedBin[] = $this->getWebPath($path);
            } else {
                $this->fp->warn('Broken YML load file "' . $key . ': ' . $map . '"');
            }
        }
        //$this->fp->log($raisedBin);

        return $raisedBin;
    }

    protected function getWebPath($path)
    {
        return preg_replace('#^.+/js/ext#', '/js/ext', $path);
    }

    protected function overrideIfExist(array $base, array $replace) {
        for($i=0; $i < sizeof($base); $i++) {
            if (in_array($base[$i], $replace)) {
                unset($base[$i]);
            }
        }
        $this->fp->log('aaa');
        $this->fp->log($replace);
$this->fp->log($base);
        $this->fp->log(array_merge($replace, $base));
        return array_merge($replace, $base);
    }
}