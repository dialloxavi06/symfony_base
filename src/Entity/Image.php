<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $chemin = null;

    #[ORM\ManyToOne(inversedBy: 'image')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vetement $vetement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChemin(): ?string
    {
        return $this->chemin;
    }

    public function setChemin(?string $chemin): static
    {
        $this->chemin = $chemin;

        return $this;
    }

    public function getVetement(): ?Vetement
    {
        return $this->vetement;
    }

    public function setVetement(?Vetement $vetement): static
    {
        $this->vetement = $vetement;

        return $this;
    }
}
