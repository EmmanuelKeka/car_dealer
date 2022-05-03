<?php


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AboutPageTest extends WebTestCase
{
    public function testTittle(): void
    {
        $url = '/About';
        $httpMethod = 'GET';
        $client = static::createClient();
        $searchText = 'About';
        $cssSelector = 'title';
        $crawler = $client->request($httpMethod, $url);
        $content = $client->getResponse()->getContent();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains($cssSelector, $searchText);
    }
    public function testHeading(): void
    {
        $url = '/About';
        $httpMethod = 'GET';
        $client = static::createClient();
        $searchText = 'About Us';
        $cssSelector = 'h1';
        $crawler = $client->request($httpMethod, $url);
        $content = $client->getResponse()->getContent();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains($cssSelector, $searchText);
    }
    public function testParagraphe(): void
    {
        $url = '/About';
        $httpMethod = 'GET';
        $client = static::createClient();
        $searchText = 'BestCar Was founded by Emmanuel Keka in 2005 with his colege Linda Veloso since then BestCar has become one of the biggest,';
        $cssSelector = 'p';
        $crawler = $client->request($httpMethod, $url);
        $content = $client->getResponse()->getContent();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains($cssSelector, $searchText);
    }
}
