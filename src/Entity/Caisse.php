<?php

namespace App\Entity;

use App\Repository\CaisseRepository;
use App\Trait\addFilesCDUTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


#[ORM\Entity(repositoryClass: CaisseRepository::class)]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false, hardDelete: true)]
class Caisse
{
    use addFilesCDUTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Seminaire $seminaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function decrement(float $montant)
    {
        $this->montant -= $montant;
        return $montant;
    }

    public function increment(float $montant)
    {
        $this->montant += $montant;
        return $montant;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getSeminaire(): ?Seminaire
    {
        return $this->seminaire;
    }

    public function setSeminaire(?Seminaire $seminaire): static
    {
        $this->seminaire = $seminaire;

        return $this;
    }
}
