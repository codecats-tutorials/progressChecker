<?php

namespace CodeCats\PanelBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SendControllerTest extends WebTestCase
{
    public function testEmail()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'send/email');
    }

}
