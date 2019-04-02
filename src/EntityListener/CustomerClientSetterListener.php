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
 * Class CustomerClientSetterListener
 *
 * @package App\EntityListener
 */
class CustomerClientSetterListener
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * CustomerClientSetterListener constructor.
     *
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param Customer $customer
     */
    public function prePersist(Customer $customer)
    {
        $customer->setClient($this->tokenStorage->getToken()->getUser());
    }

}