<?php

namespace CodeCats\PanelBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

//        $crawler = $client->request('GET', '/panel');
//
//        $this->assertTrue($crawler->filter('html')->count() > 0);
    }
}
