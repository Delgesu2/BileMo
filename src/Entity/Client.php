<?php

namespace App\Entity;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as CustomAssert;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;


/**
 * Class Client
 *
 * @ORM\Entity
 * @ORM\EntityListeners({
 *     "App\EntityListener\HashPasswordListener"
 * })
 *
 *
 */
class Client implements UserInterface
{
    /**
     * @var string Client id
     *
     * @ORM\Id
     * @ORM\Column(type="guid")
     *
     */
    private $id;

    /**
     * @var string Client name
     *
     * @ORM\Column(type="string", length=60, unique=true)
     *
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @var string Client email address
     *
     * @ORM\Column(type="string", length=60, unique=true)
     *
     * @Assert\NotBlank()
     *
     * @Assert\Email(message="Adresse courriel non valide.")
     */
    private $email;

    /**
     * @var  string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(message="Donner un mot-de-passe")
     *
     * @CustomAssert\Password
     */
    private $plainPassword;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255)
     *
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $salt;

    /**
     * @var string CLient phone number
     *
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $phoneNumber;

    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable")
     */
    private $createAt;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

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
        $this->createAt = new \DateTimeImmutable();
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
    public function getPlainPassword(): string
    {
        return $this->plainPassword;
    }

    /**
     * @param null|string $plainPassword
     */
    public function setPlainPassword(?string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @param string $salt
     */
    public function setSalt(string $salt): void
    {
        $this->salt = $salt;
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

    /**
     * @return null|string
     */
    public function getSalt(): ?string
    {
        return $this->salt;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }
}