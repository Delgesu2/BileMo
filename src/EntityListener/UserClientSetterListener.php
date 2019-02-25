<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 25/02/19
 * Time: 23:04
 */

namespace App\EntityListener;

use App\Entity\Customer;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class UserClientSetterListener
 *
 * @package App\EntityListener
 */
class UserClientSetterListener
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * UserClientSetterListener constructor.
     *
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param Customer $customer
     *
     * @param LifecycleEventArgs $eventArgs
     */
    public function prePersist(Customer $customer, LifecycleEventArgs $eventArgs)
    {
        $customer->setClient($this->tokenStorage->getToken()->getUser());
    }

}