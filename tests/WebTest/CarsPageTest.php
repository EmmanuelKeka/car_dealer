<?php


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CarsPageTest extends WebTestCase
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
        $url = '/Cars';
        $httpMethod = 'GET';
        $client = static::createClient();
        $searchText = 'Cars';
        $cssSelector = 'h1';
        $crawler = $client->request($httpMethod, $url);
        $content = $client->getResponse()->getContent();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains($cssSelector, $searchText);
    }

    public function testHeading2(): void
    {
        $url = '/Cars';
        $httpMethod = 'GET';
        $client = static::createClient();
        $searchText = 'Make: Audi';
        $cssSelector = 'h2';
        $crawler = $client->request($httpMethod, $url);
        $content = $client->getResponse()->getContent();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains($cssSelector, $searchText);
    }
}
