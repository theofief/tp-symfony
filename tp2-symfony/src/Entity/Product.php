<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Product
{
    #[Assert\NotBlank(message: "Le nom est obligatoire")]
    #[Assert\Length(
        min: 3,
        max: 100,
        minMessage: "Le nom doit faire au moins {{ limit }} caractères",
        maxMessage: "Le nom ne peut pas dépasser {{ limit }} caractères"
    )]
    private ?string $name = null;

    #[Assert\NotBlank(message: "La description est obligatoire")]
    #[Assert\Length(
        min: 10,
        max: 500,
        minMessage: "La description doit faire au moins {{ limit }} caractères",
        maxMessage: "La description ne peut pas dépasser {{ limit }} caractères"
    )]
    private ?string $description = null;

    #[Assert\NotNull(message: "Le prix est obligatoire")]
    #[Assert\Positive(message: "Le prix doit être un nombre positif")]
    private ?float $price = null;

    #[Assert\NotBlank(message: "La marque est obligatoire")]
    private ?string $brand = null;

    #[Assert\NotNull(message: "La date de création est obligatoire")]
    #[Assert\Type(\DateTimeInterface::class, message: "La date n'est pas valide")]
    private ?\DateTimeInterface $createdAt = null;

    // --------------------
    // GETTERS / SETTERS
    // --------------------

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

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}