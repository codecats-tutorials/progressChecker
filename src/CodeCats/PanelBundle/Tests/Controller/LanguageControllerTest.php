<?php

namespace CodeCats\PanelBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LanguageControllerTest extends WebTestCase
{
    public function testSwitchlanguage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/switchLanguage');
    }

}
