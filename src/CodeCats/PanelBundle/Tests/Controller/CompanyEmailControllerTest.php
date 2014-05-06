<?php

namespace CodeCats\PanelBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CompanyEmailControllerTest extends WebTestCase
{
    public function testGet()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'code_cats_panel_company_email_get');
    }

    public function testUpdate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'code_cats_panel_company_email_update');
    }

    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'code_cats_panel_company_email_create');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'code_cats_panel_company_email_delete');
    }

}
