<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class PhoneTest
 *
 * @package App\Tests
 */
class PhoneTest extends WebTestCase
{
    /**
     * @param string $username
     * @param string $password
     *
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */
    protected function createAuthenticatedClient($username = 'user', $password = 'password')
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/login_check',
            array(
                'username' => $username,
                'password' => $password,
            )
        );

        $data = json_decode($client->getResponse()->getContent(), true);

        $client = static::createClient();
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return $client;
    }

    /**
     *  test get phones
     */
    public function testPhones()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('GET', 'api/phones');
    }
}
