<?php

namespace App\Entity;

use App\Repository\SeminaireRepository;
use App\Trait\addFilesCDUTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: SeminaireRepository::class)]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false, hardDelete: true)]
class Seminaire
{
    use addFilesCDUTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $theme = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateFin = null;

    #[ORM\Column(length: 255)]
    private ?string $pco = null;

    #[ORM\Column(length: 255)]
    private ?string $pco_a = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    /**
     * @var Collection<int, Seminariste>
     */
    #[ORM\OneToMany(targetEntity: Seminariste::class, mappedBy: 'seminaire')]
    private Collection $seminaristes;

    #[ORM\Column(length: 255)]
    private ?string $Libelle = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\Column]
    private ?float $montant = null;

    /**
     * @var Collection<int, Entree>
     */
    #[ORM\OneToMany(targetEntity: Entree::class, mappedBy: 'seminaire')]
    private Collection $entrees;

    /**
     * @var Collection<int, Sortie>
     */
    #[ORM\OneToMany(targetEntity: Sortie::class, mappedBy: 'seminaire')]
    private Collection $sorties;

    #[ORM\ManyToOne(inversedBy: 'seminaires')]
    private ?Annee $annee = null;

    public function __construct()
    {
        $this->seminaristes = new ArrayCollection();
        $this->entrees = new ArrayCollection();
        $this->sorties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->DateFin;
    }

    public function setDateFin(\DateTimeInterface $DateFin): static
    {
        $this->DateFin = $DateFin;

        return $this;
    }

    public function getPco(): ?string
    {
        return $this->pco;
    }

    public function setPco(string $pco): static
    {
        $this->pco = $pco;

        return $this;
    }

    public function getPcoA(): ?string
    {
        return $this->pco_a;
    }

    public function setPcoA(string $pco_a): static
    {
        $this->pco_a = $pco_a;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * @return Collection<int, Seminariste>
     */
    public function getSeminaristes(): Collection
    {
        return $this->seminaristes;
    }

    public function addSeminariste(Seminariste $seminariste): static
    {
        if (!$this->seminaristes->contains($seminariste)) {
            $this->seminaristes->add($seminariste);
            $seminariste->setSeminaire($this);
        }

        return $this;
    }

    public function removeSeminariste(Seminariste $seminariste): static
    {
        if ($this->seminaristes->removeElement($seminariste)) {
            // set the owning side to null (unless already changed)
            if ($seminariste->getSeminaire() === $this) {
                $seminariste->setSeminaire(null);
            }
        }

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(string $Libelle): static
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

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

    /**
     * @return Collection<int, Entree>
     */
    public function getEntrees(): Collection
    {
        return $this->entrees;
    }

    public function addEntree(Entree $entree): static
    {
        if (!$this->entrees->contains($entree)) {
            $this->entrees->add($entree);
            $entree->setSeminaire($this);
        }

        return $this;
    }

    public function removeEntree(Entree $entree): static
    {
        if ($this->entrees->removeElement($entree)) {
            // set the owning side to null (unless already changed)
            if ($entree->getSeminaire() === $this) {
                $entree->setSeminaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Sortie>
     */
    public function getSorties(): Collection
    {
        return $this->sorties;
    }

    public function addSorty(Sortie $sorty): static
    {
        if (!$this->sorties->contains($sorty)) {
            $this->sorties->add($sorty);
            $sorty->setSeminaire($this);
        }

        return $this;
    }

    public function removeSorty(Sortie $sorty): static
    {
        if ($this->sorties->removeElement($sorty)) {
            // set the owning side to null (unless already changed)
            if ($sorty->getSeminaire() === $this) {
                $sorty->setSeminaire(null);
            }
        }

        return $this;
    }

    public function getAnnee(): ?Annee
    {
        return $this->annee;
    }

    public function setAnnee(?Annee $annee): static
    {
        $this->annee = $annee;

        return $this;
    }
}
