<?php
// src/Entity/Price.php

namespace App\Entity;

use App\Repository\PriceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PriceRepository::class)]
class Price
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'price', targetEntity: Vetement::class)]
    private Collection $vetements;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $prix = null;

    #[ORM\OneToMany(mappedBy: 'prix', targetEntity: Chaussure::class)]
    private Collection $chaussures;

    public function __construct()
    {
        $this->vetements = new ArrayCollection();
        $this->chaussures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection<int, Vetement>
     */
    public function getVetements(): Collection
    {
        return $this->vetements;
    }

    public function addVetement(Vetement $vetement): static
    {
        if (!$this->vetements->contains($vetement)) {
            $this->vetements->add($vetement);
            $vetement->setPrice($this);
        }

        return $this;
    }

    public function removeVetement(Vetement $vetement): static
    {
        if ($this->vetements->removeElement($vetement)) {
            // set the owning side to null (unless already changed)
            if ($vetement->getPrice() === $this) {
                $vetement->setPrice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Chaussure>
     */
    public function getChaussures(): Collection
    {
        return $this->chaussures;
    }

    public function addChaussure(Chaussure $chaussure): static
    {
        if (!$this->chaussures->contains($chaussure)) {
            $this->chaussures->add($chaussure);
            $chaussure->setPrix($this);
        }

        return $this;
    }

    public function removeChaussure(Chaussure $chaussure): static
    {
        if ($this->chaussures->removeElement($chaussure)) {
            // set the owning side to null (unless already changed)
            if ($chaussure->getPrix() === $this) {
                $chaussure->setPrix(null);
            }
        }

        return $this;
    }
}
