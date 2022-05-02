<?php

namespace App\Tests\WebTest;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginPageTest extends WebTestCase
{
    public function testTittle(): void
    {
        $url = '/login';
        $httpMethod = 'GET';
        $client = static::createClient();
        $searchText = 'Log in!';
        $cssSelector = 'title';
        $crawler = $client->request($httpMethod, $url);
        $content = $client->getResponse()->getContent();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains($cssSelector, $searchText);
    }
    public function testHeading(): void
    {
        $url = '/login';
        $httpMethod = 'GET';
        $client = static::createClient();
        $searchText = 'Please sign in';
        $cssSelector = 'h1';
        $crawler = $client->request($httpMethod, $url);
        $content = $client->getResponse()->getContent();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains($cssSelector, $searchText);
    }
    public function testLabel(): void
    {
        $url = '/About';
        $httpMethod = 'GET';
        $client = static::createClient();
        $searchText = 'Username';
        $cssSelector = 'label';
        $crawler = $client->request($httpMethod, $url);
        $content = $client->getResponse()->getContent();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains($cssSelector, $searchText);
    }
}
