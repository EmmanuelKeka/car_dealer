<?php


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;

class ProfilePageTest extends WebTestCase
{
    public function testTittle(): void
    {
        $method = 'GET';
        $url = '/profile';
        $username = 'admin';
        $okay200Code = Response::HTTP_OK;
        $client = static::createClient();
        $client->followRedirects();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByUsername($username);
        $client->loginUser($testUser);
        $crawler = $client->request($method, $url);
        $this->assertResponseIsSuccessful();
        $responseCode = $client->getResponse()->getStatusCode();
        $this->assertSame($okay200Code, $responseCode);
        $expectedText = 'Username: admin';
        $contentSelector = 'h2';
        $this->assertSelectorTextContains($contentSelector, $expectedText);

    }

}
