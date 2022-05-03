<?php


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SignUpPageTest extends WebTestCase
{
    public function testTittle(): void
    {
        $url = '/signup';
        $httpMethod = 'GET';
        $client = static::createClient();
        $searchText = 'SignUp';
        $cssSelector = 'title';
        $crawler = $client->request($httpMethod, $url);
        $content = $client->getResponse()->getContent();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains($cssSelector, $searchText);
    }
    public function testheading(): void
    {
        $url = '/signup';
        $httpMethod = 'GET';
        $client = static::createClient();
        $searchText = 'Sign Up';
        $cssSelector = 'h2';
        $crawler = $client->request($httpMethod, $url);
        $content = $client->getResponse()->getContent();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains($cssSelector, $searchText);
    }
}
