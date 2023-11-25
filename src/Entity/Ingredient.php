<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: "La valeur doit contenir au moins {{ limit }} caractères",
        maxMessage: "La valeur doit contenir au plus {{ limit }} caractères"
    )]    private ?string $name = null;

    #[ORM\Column(type: 'float', nullable: true)]
    #[Assert\Type(type: 'float', message: 'Le prix doit être un nombre.')]
    #[Assert\PositiveOrZero(message: 'Le prix doit être un nombre positif ou zéro.')]
    private ?float $price = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    #[Assert\DateTime(message: 'La date de création doit être au format DateTime.')]
    #[Assert\NotNull()]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new  \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    } 

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
