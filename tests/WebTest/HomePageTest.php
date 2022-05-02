<?php

namespace App\Tests\WebTest;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomePageTest extends WebTestCase
{
    public function testHeading(): void
    {
        $url = '/';
        $httpMethod = 'GET';
        $client = static::createClient();
        $searchText = 'Welcome to FunCarDealer';
        $cssSelector = 'h1';
        $crawler = $client->request($httpMethod, $url);
        $content = $client->getResponse()->getContent();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains($cssSelector, $searchText);
    }
    public function testParagraphe(): void
    {
        $url = '/';
        $httpMethod = 'GET';
        $client = static::createClient();
        $searchText = 'here you will find find beatiful cars for all at a creat price';
        $cssSelector = 'p';
        $crawler = $client->request($httpMethod, $url);
        $content = $client->getResponse()->getContent();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains($cssSelector, $searchText);
    }
}
