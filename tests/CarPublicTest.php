<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CarPublicTest extends WebTestCase
{
    public function testTittle(): void
    {
        $url = '/Cars';
        $httpMethod = 'GET';
        $client = static::createClient();
        $searchText = 'Cars';
        $cssSelector = 'title';
        $crawler = $client->request($httpMethod, $url);
        $content = $client->getResponse()->getContent();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains($cssSelector, $searchText);
    }
    public function testHeading(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/Cars');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Cars');
    }
}
