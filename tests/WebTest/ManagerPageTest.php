<?php

namespace App\Tests\WebTest;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;


class ManagerPageTest extends WebTestCase
{
    public function testTittle(): void
    {
        $method = 'GET';
        $url = '/view_sales';
        $username = 'manager';
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
        $expectedText = 'sells';
        $contentSelector = 'title';
        $this->assertSelectorTextContains($contentSelector, $expectedText);
    }

    public function testHeading(): void
    {
        $method = 'GET';
        $url = '/view_sales';
        $username = 'manager';
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
        $expectedText = 'Sells';
        $contentSelector = 'h1';
        $this->assertSelectorTextContains($contentSelector, $expectedText);
    }

    public function testOtherUserAccessDenied(): void
    {
        $method = 'GET';
        $url = '/view_sales';
        $username = 'admin';
        $accessDeniedResponseCode403 = Response::HTTP_FORBIDDEN;
        $client = static::createClient();
        $client->followRedirects();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByUsername($username);
        $client->loginUser($testUser);
        $crawler = $client->request($method, $url);
        $responseCode = $client->getResponse()->getStatusCode();
        $this->assertSame($accessDeniedResponseCode403, $responseCode);
    }
}
