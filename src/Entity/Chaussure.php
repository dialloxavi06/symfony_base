<?php

namespace App\Entity;

use App\Repository\ChaussureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChaussureRepository::class)]
class Chaussure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $pointure = null; 

    #[ORM\ManyToOne(inversedBy: 'chaussures')]
    private ?Price $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'chaussure', targetEntity: Marque::class)]
    private Collection $marque;

    public function __construct()
    {
        $this->marque = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPointure(): ?float
    {
        return $this->pointure;
    }

    public function setPointure(float $pointure): static
    {
        $this->pointure = $pointure;

        return $this;
    }

    public function getPrix(): ?Price
    {
        return $this->prix;
    }

    public function setPrix(?Price $prix): static
    {
        $this->prix = $prix;

        return $this;
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
     * @return Collection<int, Marque>
     */
    public function getMarque(): Collection
    {
        return $this->marque;
    }

    public function addMarque(Marque $marque): static
    {
        if (!$this->marque->contains($marque)) {
            $this->marque->add($marque);
            $marque->setChaussure($this);
        }

        return $this;
    }

    public function removeMarque(Marque $marque): static
    {
        if ($this->marque->removeElement($marque)) {
            // set the owning side to null (unless already changed)
            if ($marque->getChaussure() === $this) {
                $marque->setChaussure(null);
            }
        }

        return $this;
    }
}
