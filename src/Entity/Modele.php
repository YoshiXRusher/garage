<?php

namespace App\Entity;

use App\Repository\ModeleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModeleRepository::class)]
class Modele
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $createAt = null;

    #[ORM\ManyToOne(inversedBy: 'modeles')]
    private ?Marque $Marque = null;

    #[ORM\OneToMany(mappedBy: 'modele', targetEntity: Voiture::class)]
    private Collection $Voiture;

    public function __construct()
    {
        $this->Voiture = new ArrayCollection();
    }
    
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

    public function getCreateAt(): ?int
    {
        return $this->createAt;
    }

    public function setCreateAt(int $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->Marque;
    }

    public function setMarque(?Marque $Marque): self
    {
        $this->Marque = $Marque;

        return $this;
    }

    /**
     * @return Collection<int, Voiture>
     */
    public function getVoiture(): Collection
    {
        return $this->Voiture;
    }

    public function addVoiture(Voiture $voiture): self
    {
        if (!$this->Voiture->contains($voiture)) {
            $this->Voiture->add($voiture);
            $voiture->setModele($this);
        }

        return $this;
    }

    public function removeVoiture(Voiture $voiture): self
    {
        if ($this->Voiture->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getModele() === $this) {
                $voiture->setModele(null);
            }
        }

        return $this;
    }

}
