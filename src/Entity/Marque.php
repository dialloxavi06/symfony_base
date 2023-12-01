<?php

namespace App\Entity;

use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarqueRepository::class)]
class Marque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'marques', targetEntity: Vetement::class)]
    private Collection $Vetements;

/**
 * @ORM\ManyToOne(targetEntity=Marque::class)
 */
private ?Marque $marques = null;

#[ORM\ManyToOne(inversedBy: 'marque')]
private ?Chaussure $chaussure = null;

    public function __construct()
    {
        $this->Vetements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Vetement>
     */
    public function getVetements(): Collection
    {
        return $this->Vetements;
    }

    public function addVetement(Vetement $vetement): static
    {
        if (!$this->Vetements->contains($vetement)) {
            $this->Vetements->add($vetement);
            $vetement->setMarque($this);
        }

        return $this;
    }

    public function removeVetement(Vetement $vetement): static
    {
        if ($this->Vetements->removeElement($vetement)) {
            if ($vetement->getMarque() === $this) {
                $vetement->setMarque(null);
            }
        }

        return $this;
    }
    public function setMarques(?Marque $marques): static
{
    $this->marques = $marques;

    return $this;
}
public function __toString()
{
    return $this->nom; 
}

public function getChaussure(): ?Chaussure
{
    return $this->chaussure;
}

public function setChaussure(?Chaussure $chaussure): static
{
    $this->chaussure = $chaussure;

    return $this;
}

}
