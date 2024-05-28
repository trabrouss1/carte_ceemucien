<?php

namespace App\Entity;

use App\Repository\SeminaristeRepository;
use App\Trait\addFilesCDUTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


#[ORM\Entity(repositoryClass: SeminaristeRepository::class)]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false, hardDelete: true)]
class Seminariste
{
    use addFilesCDUTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'seminaristes')]
    private ?Seminaire $seminaire = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $pnom = null;

    #[ORM\Column(length: 255)]
    private ?string $niveau = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(length: 255)]
    private ?string $lieuNaissance = null;

    #[ORM\ManyToOne(inversedBy: 'seminaristes')]
    private ?Coordination $coordination = null;

    #[ORM\Column(length: 255)]
    private ?string $sexe = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $section = null;

    #[ORM\Column]
    private ?bool $djinn = null;

    #[ORM\Column]
    private ?bool $isUlcere = null;

    #[ORM\Column]
    private ?bool $isTuberculose = null;

    #[ORM\Column]
    private ?bool $isAsthme = null;

    #[ORM\Column]
    private ?bool $isGrossesse = null;

    #[ORM\Column]
    private ?bool $isDiabète = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contact = null;

    #[ORM\Column(length: 255)]
    private ?string $nomPrenomParent = null;

    #[ORM\Column(length: 255)]
    private ?string $contactParent = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $autreMalidie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $remedeAutreMalidie = null;

    #[ORM\Column(length: 255)]
    private ?string $matricule = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $personneConfiance = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactPersonneConfiance = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPnom(): ?string
    {
        return $this->pnom;
    }

    public function setPnom(string $pnom): static
    {
        $this->pnom = $pnom;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieuNaissance;
    }

    public function setLieuNaissance(string $lieuNaissance): static
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    public function getCoordination(): ?Coordination
    {
        return $this->coordination;
    }

    public function setCoordination(?Coordination $coordination): static
    {
        $this->coordination = $coordination;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): static
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getSection(): ?string
    {
        return $this->section;
    }

    public function setSection(?string $section): static
    {
        $this->section = $section;

        return $this;
    }

    public function isDjinn(): ?bool
    {
        return $this->djinn;
    }

    public function setDjinn(bool $djinn): static
    {
        $this->djinn = $djinn;

        return $this;
    }

    public function isUlcere(): ?bool
    {
        return $this->isUlcere;
    }

    public function setUlcere(bool $isUlcere): static
    {
        $this->isUlcere = $isUlcere;

        return $this;
    }

    public function isTuberculose(): ?bool
    {
        return $this->isTuberculose;
    }

    public function setTuberculose(bool $isTuberculose): static
    {
        $this->isTuberculose = $isTuberculose;

        return $this;
    }

    public function isAsthme(): ?bool
    {
        return $this->isAsthme;
    }

    public function setAsthme(bool $isAsthme): static
    {
        $this->isAsthme = $isAsthme;

        return $this;
    }

    public function isGrossesse(): ?bool
    {
        return $this->isGrossesse;
    }

    public function setGrossesse(bool $isGrossesse): static
    {
        $this->isGrossesse = $isGrossesse;

        return $this;
    }

    public function isDiabète(): ?bool
    {
        return $this->isDiabète;
    }

    public function setDiabète(bool $isDiabète): static
    {
        $this->isDiabète = $isDiabète;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(?string $contact): static
    {
        $this->contact = $contact;

        return $this;
    }

    public function getNomPrenomParent(): ?string
    {
        return $this->nomPrenomParent;
    }

    public function setNomPrenomParent(string $nomPrenomParent): static
    {
        $this->nomPrenomParent = $nomPrenomParent;

        return $this;
    }

    public function getContactParent(): ?string
    {
        return $this->contactParent;
    }

    public function setContactParent(string $contactParent): static
    {
        $this->contactParent = $contactParent;

        return $this;
    }

    public function getAutreMalidie(): ?string
    {
        return $this->autreMalidie;
    }

    public function setAutreMalidie(string $autreMalidie): static
    {
        $this->autreMalidie = $autreMalidie;

        return $this;
    }

    public function getRemedeAutreMalidie(): ?string
    {
        return $this->remedeAutreMalidie;
    }

    public function setRemedeAutreMalidie(?string $remedeAutreMalidie): static
    {
        $this->remedeAutreMalidie = $remedeAutreMalidie;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): static
    {
        $this->matricule = $matricule;

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

    public function getPersonneConfiance(): ?string
    {
        return $this->personneConfiance;
    }

    public function setPersonneConfiance(?string $personneConfiance): static
    {
        $this->personneConfiance = $personneConfiance;

        return $this;
    }

    public function getContactPersonneConfiance(): ?string
    {
        return $this->contactPersonneConfiance;
    }

    public function setContactPersonneConfiance(?string $contactPersonneConfiance): static
    {
        $this->contactPersonneConfiance = $contactPersonneConfiance;

        return $this;
    }
}
