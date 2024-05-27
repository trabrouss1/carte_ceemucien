<?php

namespace App\Entity;

use App\Repository\DortoirsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DortoirsRepository::class)]
class Dortoirs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;
    
    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    #[ORM\ManyToOne(inversedBy: 'dortoirs')]
    private ?Batiement $batiment = null;

    #[ORM\Column]
    private ?float $placeDisponible = null;

    #[ORM\Column]
    private ?float $nombreDePlaces = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }
    
    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getBatiment(): ?Batiement
    {
        return $this->batiment;
    }

    public function setBatiment(?Batiement $batiment): static
    {
        $this->batiment = $batiment;

        return $this;
    }

    public function getPlaceDisponible(): ?float
    {
        return $this->placeDisponible;
    }

    public function setPlaceDisponible(float $placeDisponible): static
    {
        $this->placeDisponible = $placeDisponible;

        return $this;
    }

    public function getNombreDePlaces(): ?float
    {
        return $this->nombreDePlaces;
    }

    public function setNombreDePlaces(float $nombreDePlaces): static
    {
        $this->nombreDePlaces = $nombreDePlaces;

        return $this;
    }
}
