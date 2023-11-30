<?php

namespace App\Entity;

use App\Repository\VetementRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: VetementRepository::class)]
class Vetement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(targetEntity: Marque::class)]
    #[ORM\JoinColumn(name: "marque_id", referencedColumnName: "id")]
    private ?Marque $marque = null; // Change the property name to singular


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tailles = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(nullable: true)]   
    private ?\DateTimeImmutable $deletedAt = null;

    #[ORM\OneToMany(mappedBy: 'vetement', targetEntity: Commentaire::class)]
    private Collection $commentaires;

    #[ORM\OneToMany(targetEntity: Image::class, mappedBy: 'vetement', cascade: ['persist', 'remove'])]
    private Collection $images;

    public function __construct()
    {
        $this->tailles = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->deletedAt = new \DateTimeImmutable();
        $this->images = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    
    public function getMarque(): ?Marque
    {
        return $this->marque;
    }
  
    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }
    

    public function getTailles(): ?string
    {
        return $this->tailles;
    }

    public function setTailles(?string $tailles): static
    {
        $this->tailles = $tailles;

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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(\DateTimeImmutable $deletedAt): static
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): static
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setVetement($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): static
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getVetement() === $this) {
                $commentaire->setVetement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function setImages(?string $image): static
    {
        $this->images = $image;

        return $this;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setVetement($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getVetement() === $this) {
                $image->setVetement(null);
            }
        }

        return $this;
    }

    // Add the following method to add multiple tailles
    public function addTaille(string $taille): static
    {
        $this->tailles[] = $taille;

        return $this;
    }

   
}
