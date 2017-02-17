<?php

namespace AppBundle\Tests;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class AbstractOAuthCase
 * @package Tests\AppBundle\Controller
 */
abstract class AbstractAuthCase extends WebTestCase
{
    protected static $client;

    protected function setUp()
    {
        // Setup only once
        if (static::$client) {
            return true;
        }

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

        return static::$client = [
            $client,
            [
                'HTTP_Authorization' => 'Bearer '.$content['access_token'],
            ],
        ];
    }

    protected function getClient()
    {
        return static::$client;
    }
}
