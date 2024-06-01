<?php

namespace App\Entity;

use App\Repository\EntreeRepository;
use App\Trait\addFilesCDUTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


#[ORM\Entity(repositoryClass: EntreeRepository::class)]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false, hardDelete: true)]
class Entree
{
    use addFilesCDUTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\ManyToOne(inversedBy: 'entrees')]
    private ?Seminaire $seminaire = null;

    #[ORM\ManyToOne(inversedBy: 'entrees')]
    private ?Seminariste $seminariste = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
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

    public function getSeminariste(): ?Seminariste
    {
        return $this->seminariste;
    }

    public function setSeminariste(?Seminariste $seminariste): static
    {
        $this->seminariste = $seminariste;

        return $this;
    }
}
