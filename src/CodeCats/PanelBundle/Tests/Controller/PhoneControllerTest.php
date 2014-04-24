<?php

namespace CodeCats\PanelBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PhoneControllerTest extends WebTestCase
{
    public function testGet()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/phone');
    }

    public function testUpdate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/phone');
    }

    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/phone');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/phone/{id}');
    }

}
