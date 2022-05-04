<?php

namespace App\Tests\WebTest;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserRoleAccessibilityTest extends WebTestCase
{
    public function testTransactionPageAccess(): void
    {
        $method = 'GET';
        $url = '/transaction/';
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
        $expectedText = 'Transaction index';
        $contentSelector = 'h1';
        $this->assertSelectorTextContains($contentSelector, $expectedText);
    }
    public function testUserPageAccess(): void
    {
        $method = 'GET';
        $url = '/user/';
        $username = 'hr';
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
        $expectedText = 'User index';
        $contentSelector = 'h1';
        $this->assertSelectorTextContains($contentSelector, $expectedText);
    }
    public function testCarPageAccess(): void
    {
        $method = 'GET';
        $url = '/user/';
        $username = 'hr';
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
        $expectedText = 'User index';
        $contentSelector = 'h1';
        $this->assertSelectorTextContains($contentSelector, $expectedText);
    }

    public function testTransactionPageAccessDenied(): void
    {
        $method = 'GET';
        $url = '/transaction/';
        $username = 'manager';
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
    //if the user have the wrong role they will be redirect to the homepage with a Flash message
    //  'sorry - you tried to access a page for which you do not have permission'
    public function testUserPageAccessDenied(): void
    {
        $method = 'GET';
        $url = '/user/';
        $username = 'manager';
        $client = static::createClient();
        $client->followRedirects();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByUsername($username);
        $client->loginUser($testUser);
        $crawler = $client->request($method, $url);
        $responseCode = $client->getResponse()->getStatusCode();
        $expectedText = 'sorry - you tried to access a page for which you do not have permission';
        $contentSelector = 'body';
        $this->assertSelectorTextContains($contentSelector, $expectedText);
    }

    //if the user have the wrong role they will be redirect to the homepage with a Flash message
    //  'sorry - you tried to access a page for which you do not have permission'
    public function testCarPageAccessDenied(): void
    {
        $method = 'GET';
        $url = '/user/';
        $username = 'customer';
        $client = static::createClient();
        $client->followRedirects();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByUsername($username);
        $client->loginUser($testUser);
        $crawler = $client->request($method, $url);
        $responseCode = $client->getResponse()->getStatusCode();
        $expectedText = 'sorry - you tried to access a page for which you do not have permission';
        $contentSelector = 'body';
        $this->assertSelectorTextContains($contentSelector, $expectedText);
    }
}
