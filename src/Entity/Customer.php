<?php

namespace App\Entity;

use Ramsey\Uuid\Uuid;
use Hateoas\Configuration\Annotation as Hateoas;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Customer
 *
 * @ApiResource(
 *     collectionOperations={
 *        "get"={"access_control"="object.client == user", "access_control_message" =
 *        "Vous n'avez pas accès à la liste." },
 *        "post"={"access_control" = "Vous ne pouvez effectuer cette action."}
 *
 * },
 *     itemOperations={
 *         "get"={"access_control"="object.client == user", "access_control_message" =
 *         "Vous n'avez pas l'autorisation d'obtenir cette information."},
 *         "delete"={"access_control" = "Vous ne pouvez effectuer cette action."},
 *         "put"={"access_control" = "Vous ne pouvez effectuer cette action."}
 *     }
 *)
 *
 *
 * @ORM\Entity
 *
 * @Hateoas\Relation(
 *     "self",
 *     href = @Hateoas\Route(
 *         "customer_show",
 *         parameters = { "id" = "expr(object.getId())" },
 *         absolute = true
 *     )
 * )
 *
 * @Hateoas\Relation(
 *     "delete_a_customer",
 *     href = @Hateoas\Route(
 *         "customer_del",
 *         parameters = { "id" = "expr(object.getId())" },
 *         absolute = true
 *     )
 * )
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
     */
    private $id;

    /**
     * @var string Customer First Name
     *
     * @ORM\Column(type="string", length=40, unique=false)
     */
    private $firstName;

    /**
     * @var string Customer Last Name
     *
     * @ORM\Column(type="string", length=60, unique=false)
     *
     * @Assert\NotBlank(message="Il faut renseigner au minimum le nom de famille")
     */
    private $lastName;

    /**
     * @var string Customer address
     *
     * @ORM\Column(type="string", length=80)
     */
    private $address;

    /**
     * @var string Customer's adress zipcode
     *
     * @ORM\Column(type="string", length=15)
     */
    private $zipcode;

    /**
     * @var string City where the Customer lives
     *
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\NotBlank()
     */
    private $city;

    /**
     * @var string Customer phone number
     *
     * @ORM\Column(type="string", length=25)
     *
     * @Assert\NotBlank()
     */
    private $phoneNumber;

    /**
     * @var string Customer email
     *
     * @ORM\Column(type="string", length=40)
     *
     * @Assert\Email(message="Adresse courriel non valide.")
     */
    private $email;

    /**
     * @var \DateTimeInterface When the customer entity has been created
     *
     * @ORM\Column(type="datetime_immutable")
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
        $this->id       = Uuid::uuid4();
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
    public function getClient(): Client
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