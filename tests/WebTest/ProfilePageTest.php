<?php

namespace App\Tests\WebTest;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfilePageTest extends WebTestCase
{
    public function testTittle(): void
    {
        $url = '/profile';
        $httpMethod = 'GET';
        $client = static::createClient();
        $searchText = 'Profile';
        $cssSelector = 'title';
        $crawler = $client->request($httpMethod, $url);
        $content = $client->getResponse()->getContent();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains($cssSelector, $searchText);
    }
}
