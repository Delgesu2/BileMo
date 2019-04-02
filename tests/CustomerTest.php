<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class CustomerTest
 *
 * @package App\Tests
 */
class CustomerTest extends WebTestCase
{
    /**
     * @param string $username
     * @param string $plainPassword
     *
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */
    protected function createAuthenticatedClient($username = 'Xavier', $plainPassword = 'Mot2passe')
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/login_check',
            array(
                'Xavier' => $username,
                'Mot2passe' => $plainPassword,
            )
        );

        $data = json_decode($client->getResponse()->getContent(), true);

        $client = static::createClient();
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return $client;
    }

    /**
     * test get customers
     */
    public function testCustomers()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/api/customers');

    }

}