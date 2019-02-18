<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 17/02/19
 * Time: 19:45
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
     * @var UserPasswordEncoderInterface;
     */
    private $clientPasswordEncoder;

    /**
     * HashPasswordListener constructor.
     *
     * @param UserPasswordEncoderInterface $clientPasswordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $clientPasswordEncoder)
    {
        $this->clientPasswordEncoder = $clientPasswordEncoder;
    }

    /**
     * @param Client $client
     * @param LifecycleEventArgs $eventArgs
     */
    public function prePersist(Client $client, LifecycleEventArgs $eventArgs): void
    {
        $this->encodePassword($client);
    }

    public function encodePassword(Client $client)
    {
        $client->setPassword();
    }

}