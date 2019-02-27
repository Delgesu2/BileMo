<?php

namespace App\Entity;

use Ramsey\Uuid\Uuid;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use App\Annotation\UserAware;
use Hateoas\Configuration\Annotation as Hateoas;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Customer
 *
 * @UserAware(userFieldName="client_id")
 *
 * @ApiResource(
 *     collectionOperations={
 *        "get",
 *        "post"
 * },
 *     itemOperations={
 *         "get",
 *         "delete",
 *         "put"
 *     },
 *     attributes={"normalization_context"={"groups"={"get"}}}
 *)
 *
 * @ApiFilter(
 *     SearchFilter::class, properties={"lastName": "exact"}
 *     )
 *
 * @Hateoas\Relation(
 *     "delete",
 *     href = @Hateoas\Route(
 *     "app_customer_delete",
 *     parameters = { "id" = "expr(object.getId())" },
 *     absolute = true
 *     )
 * )
 *
 * @ORM\Entity
 * @ORM\EntityListeners({
 *     "App\EntityListener\CustomerClientSetterListener"
 * })
 *
 *
 */
class Customer
{
    /**
     * @var string Customer id
     *
     * @ORM\Id
     * @ORM\Column(type="guid")
     *
     * @Groups({"get"})
     *
     */
    private $id;

    /**
     * @var string Customer First Name
     *
     * @ORM\Column(type="string", length=40, unique=false)
     *
     * @Groups({"get"})
     */
    private $firstName;

    /**
     * @var string Customer Last Name
     *
     * @ORM\Column(type="string", length=60, unique=false)
     *
     * @Assert\NotBlank(message="Il faut renseigner au minimum le nom de famille")
     *
     * @Groups({"get"})
     */
    private $lastName;

    /**
     * @var string Customer address
     *
     * @ORM\Column(type="string", length=80)
     *
     * @Groups({"get"})
     */
    private $address;

    /**
     * @var string Customer's adress zipcode
     *
     * @ORM\Column(type="string", length=15)
     *
     * @Groups({"get"})
     */
    private $zipcode;

    /**
     * @var string City where the Customer lives
     *
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\NotBlank()
     *
     * @Groups({"get"})
     */
    private $city;

    /**
     * @var string Customer phone number
     *
     * @ORM\Column(type="string", length=25)
     *
     * @Assert\NotBlank()
     *
     * @Groups({"get"})
     */
    private $phoneNumber;

    /**
     * @var string Customer email
     *
     * @ORM\Column(type="string", length=40)
     *
     * @Assert\Email(message="Adresse courriel non valide.")
     *
     * @Groups({"get"})
     */
    private $email;

    /**
     * @var \DateTimeInterface When the customer entity has been created
     *
     * @ORM\Column(type="datetime_immutable")
     *
     * @Groups({"get"})
     */
    private $createdAt;

    /**
     * @var Client
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="customers")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * Customer constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->id        = Uuid::uuid4();
        $this->createdAt = new \DateTimeImmutable();
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
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     */
    public function setZipcode(string $zipcode): void
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
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
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return Client
     */
    public function getClient(): ?Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

}