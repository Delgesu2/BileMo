<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 20/02/19
 * Time: 18:25
 */

namespace App\EntityListener;

use App\Entity\Client;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class HashPasswordListener
 *
 * @package App\EntityListener
 */
class HashPasswordListener
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    /**
     * HashPasswordListener constructor.
     *
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    /**
     * @param Client $client
     * @param LifecycleEventArgs $eventArgs
     *
     * @throws \Exception
     */
    public function prePersist(Client $client, LifecycleEventArgs $eventArgs): void
    {
        $client->setSalt(uniqid(mt_rand(), true));

        $this->encodePassword($client);
    }


    /**
     * @param Client $client
     * @throws \Exception
     */
    private function encodePassword(Client $client)
    {
        if ($client->getPlainPassword() === null) {
            return;
        }

        $client->setPassword($this->userPasswordEncoder->encodePassword($client, $client->getPlainPassword()));
        $client->setPlainPassword(null);
    }

}