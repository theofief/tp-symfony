<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: false)]
    #[Assert\NotBlank(message: "Le nom est obligatoire")]
    #[Assert\Length(
        min: 3,
        max: 100,
        minMessage: "Le nom doit faire au moins {{ limit }} caractères",
        maxMessage: "Le nom ne peut pas dépasser {{ limit }} caractères"
    )]
    private ?string $name = null;

    #[ORM\Column(length: 500, nullable: false)]
    #[Assert\NotBlank(message: "La description est obligatoire")]
    #[Assert\Length(
        min: 10,
        max: 500,
        minMessage: "La description doit faire au moins {{ limit }} caractères",
        maxMessage: "La description ne peut pas dépasser {{ limit }} caractères"
    )]
    private ?string $description = null;

    #[ORM\Column(type: 'float', nullable: false)]
    #[Assert\NotNull(message: "Le prix est obligatoire")]
    #[Assert\Positive(message: "Le prix doit être un nombre positif")]
    private ?float $price = null;

    #[ORM\Column(length: 100, nullable: false)]
    #[Assert\NotBlank(message: "La marque est obligatoire")]
    private ?string $brand = null;

    #[ORM\Column(type: 'datetime', nullable: false)]
    #[Assert\NotNull(message: "La date de création est obligatoire")]
    #[Assert\Type(\DateTimeInterface::class, message: "La date ndzsq'est pas valide")]
    private ?\DateTimeInterface $createdAt = null;

    // --------------------
    // GETTERS / SETTERS
    // --------------------

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}