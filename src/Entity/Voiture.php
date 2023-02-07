<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $equipement = null;

    #[ORM\Column(length: 255)]
    private ?string $carrosserie = null;

    #[ORM\Column(length: 255)]
    private ?string $transmission = null;

    #[ORM\Column(length: 255)]
    private ?string $carburant = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCirculation = null;

    #[ORM\Column]
    private ?int $kilometrage = null;

    #[ORM\Column]
    private ?int $nbProprio = null;

    #[ORM\Column]
    private ?int $puissanceCH = null;

    #[ORM\Column]
    private ?int $puissanceKW = null;

    #[ORM\Column]
    private ?int $cylindree = null;

    #[ORM\Column]
    private ?int $nbCylindre = null;

    #[ORM\Column(length: 255)]
    private ?string $cover = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\ManyToOne(inversedBy: 'Voiture')]
    private ?Modele $modele = null;

    #[ORM\OneToMany(mappedBy: 'voiture', targetEntity: Images::class)]
    private Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEquipement(): ?string
    {
        return $this->equipement;
    }

    public function setEquipement(string $equipement): self
    {
        $this->equipement = $equipement;

        return $this;
    }

    public function getCarrosserie(): ?string
    {
        return $this->carrosserie;
    }

    public function setCarrosserie(string $carrosserie): self
    {
        $this->carrosserie = $carrosserie;

        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    public function setTransmission(string $transmission): self
    {
        $this->transmission = $transmission;

        return $this;
    }

    public function getCarburant(): ?string
    {
        return $this->carburant;
    }

    public function setCarburant(string $carburant): self
    {
        $this->carburant = $carburant;

        return $this;
    }

    public function getDateCirculation(): ?\DateTimeInterface
    {
        return $this->dateCirculation;
    }

    public function setDateCirculation(\DateTimeInterface $dateCirculation): self
    {
        $this->dateCirculation = $dateCirculation;

        return $this;
    }

    public function getKilometrage(): ?int
    {
        return $this->kilometrage;
    }

    public function setKilometrage(int $kilometrage): self
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getNbProprio(): ?int
    {
        return $this->nbProprio;
    }

    public function setNbProprio(int $nbProprio): self
    {
        $this->nbProprio = $nbProprio;

        return $this;
    }

    public function getPuissanceCH(): ?int
    {
        return $this->puissanceCH;
    }

    public function setPuissanceCH(int $puissanceCH): self
    {
        $this->puissanceCH = $puissanceCH;

        return $this;
    }

    public function getPuissanceKW(): ?int
    {
        return $this->puissanceKW;
    }

    public function setPuissanceKW(int $puissanceKW): self
    {
        $this->puissanceKW = $puissanceKW;

        return $this;
    }

    public function getCylindree(): ?int
    {
        return $this->cylindree;
    }

    public function setCylindree(int $cylindree): self
    {
        $this->cylindree = $cylindree;

        return $this;
    }

    public function getNbCylindre(): ?int
    {
        return $this->nbCylindre;
    }

    public function setNbCylindre(int $nbCylindre): self
    {
        $this->nbCylindre = $nbCylindre;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;

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

    public function getModele(): ?Modele
    {
        return $this->modele;
    }

    public function setModele(?Modele $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setVoiture($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getVoiture() === $this) {
                $image->setVoiture(null);
            }
        }

        return $this;
    }
}
