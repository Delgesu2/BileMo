<?php

namespace App\EventListener;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Orm\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\Common\Annotations\Reader;

/**
 * Class UserFilterConfigurator
 *
 * @package App\EventListener
 */
final class UserFilterConfigurator
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var Reader
     */
    private $reader;

    /**
     * UserFilterConfigurator constructor.
     *
     * @param ObjectManager $entityManager
     * @param TokenStorageInterface $tokenStorage
     * @param Reader $reader
     */
    public function __construct(ObjectManager $entityManager, TokenStorageInterface $tokenStorage, Reader $reader)
    {
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
        $this->reader = $reader;
    }

    /**
     *
     */
    public function onKernelRequest(): void
    {
        if (!$user = $this->getUser()) {
            throw new \RuntimeException('There is no authenticated user.');
        }

        $filter = $this->entityManager->getFilters()->enable('user_filter');
        $filter->setParameter('id', $user->getId());
        $filter->setAnnotationReader($this->reader);
    }

    /**
     * @return null|UserInterface
     */
    private function getUser(): ?UserInterface
    {
        if (!$token = $this->tokenStorage->getToken()) {
            return null;
        }

        $user = $token->getUser();
        return $user instanceof UserInterface ? $user : null;
    }

}