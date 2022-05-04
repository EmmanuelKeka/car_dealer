<?php


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactPageTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/ContactUs');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Contact');
    }
}
