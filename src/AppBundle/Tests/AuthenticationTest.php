<?php

namespace AppBundle\Tests;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class AuthenticationTest
 * @package AppBundle\Tests
 */
class AuthenticationTest extends WebTestCase
{
    /**
     * Test OAuth2 authentication
     */
    public function test()
    {
        // Step 1: Get tools

        $client = $this->createClient();
        $clientManager = $client->getContainer()->get('fos_oauth_server.client_manager.default');
        $auth = $clientManager->findClientBy([]);
        $doctrine = $client->getContainer()->get('doctrine');

        // Step 2: Test fail cases

        $client->request('GET', '/api/v1/profile');

        $this->assertEquals(401, $client->getResponse()->getStatusCode());

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $client->request(
            'POST',
            '/oauth/v2/token',
            [
                'grant_type' => 'password',
                'client_id' => $auth->getPublicId(),
                'client_secret' => $auth->getSecret(),
                'username' => 'wrong.credentials',
                'password' => '********',
            ]
        );

        $this->assertEquals(400, $client->getResponse()->getStatusCode());

        // Step 3: Auth user

        /** @var User $user */
        $user = $doctrine->getRepository('AppBundle:User')->findOneBy([]);
        $email = $user->getEmail();

        $client->request(
            'POST',
            '/oauth/v2/token',
            [
                'grant_type' => 'password',
                'client_id' => $auth->getPublicId(),
                'client_secret' => $auth->getSecret(),
                'username' => $email,
                'password' => 'root',
            ]
        );

        $content = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('access_token', $content);

        $header = [
            'HTTP_Authorization' => 'Bearer '.$content['access_token'],
        ];

        $client->request('GET', '/api/v1/profile', [], [], $header);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains(json_encode($user->getEmail()), $client->getResponse()->getContent());
        $this->assertContains(json_encode($user->getUserType()->getLabel()), $client->getResponse()->getContent());

        // Step 4: And with wrong header

        $wrongHeader = [
            'HTTP_Authorization' => 'Bearer '.$content['access_token'].'x',
        ];

        $client->request('GET', '/api/v1/profile', [], [], $wrongHeader);
        $this->assertEquals(401, $client->getResponse()->getStatusCode());
        $this->assertContains('"invalid_grant"', $client->getResponse()->getContent());
    }
}
