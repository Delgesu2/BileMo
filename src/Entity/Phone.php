<?php

namespace App\Entity;

use Ramsey\Uuid\Uuid;
use Hateoas\Configuration\Annotation as Hateoas;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Phone
 *
 * @ApiResource(
 *     collectionOperations={
 *     "get"
 *     },
 *
 *     itemOperations={
 *         "get"
 *     }
 * )
 *
 *
 * @ORM\Entity
 *
 *
 */
class Phone
{
    /**
     * @var string Phone id
     *
     * @ORM\Id()
     * @ORM\Column(type="guid")
     *
     */
    private $id;

    /**
     * @var string Phone brand
     *
     * @ORM\Column(type="string", length=60)
     *
     * @Assert\NotBlank()
     */
    private $brand;

    /**
     * @var string Phone reference
     *
     * @ORM\Column(type="string", length=100)
     *
     * @Assert\NotBlank()
     */
    private $reference;

    /**
     * @var string Phone description
     *
     * @ORM\Column(type="string", length=200)
     */
    private $description;

    /**
     * @var string Phone price
     *
     * @ORM\Column(type="string", length=7)
     *
     * @Assert\NotBlank()
     */
    private $price;


    /**
     * Phone constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4();
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
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice(string $price): void
    {
        $this->price = $price;
    }


}