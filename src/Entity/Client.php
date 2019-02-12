<?php

namespace App\Entity;

use Ramsey\Uuid\Uuid;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Client
 *
 * @ApiResource
 * @ORM\Entity
 */
class Client
{
    /**
     * @var string Client id
     *
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @var string Client name
     *
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $name;

    /**
     * @var string Client email address
     *
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @var string CLient phone number
     *
     * @ORM\Column(type="string", length=12, unique=true)
     */
    private $phoneNumber;

    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Customer", mappedBy="client", orphanRemoval=true)
     */
    private $customers;

    /**
     * Client constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->id       = Uuid::uuid4();
        $this->createAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreateAt(): \DateTimeImmutable
    {
        return $this->createAt;
    }

    /**
     * @param \DateTimeImmutable $createAt
     */
    public function setCreateAt(\DateTimeImmutable $createAt): void
    {
        $this->createAt = $createAt;
    }

    /**
     * @return mixed
     */
    public function getCustomers()
    {
        return $this->customers;
    }

    /**
     * @param mixed $customers
     */
    public function setCustomers($customers): void
    {
        $this->customers = $customers;
    }

}