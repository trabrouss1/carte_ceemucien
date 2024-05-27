<?php

namespace App\Entity;

use App\Repository\AnneeRepository;
use App\Trait\addFilesCDUTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


#[ORM\Entity(repositoryClass: AnneeRepository::class)]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false, hardDelete: true)]
class Annee
{
    use addFilesCDUTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column]
    private ?bool $achevee = null;

    /**
     * @var Collection<int, Batiment>
     */
    #[ORM\OneToMany(targetEntity: Batiment::class, mappedBy: 'annee')]
    private Collection $batiements;

    public function __construct()
    {
        $this->batiements = new ArrayCollection();
    }

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

    public function isAchevee(): ?bool
    {
        return $this->achevee;
    }

    public function setAchevee(bool $achevee): static
    {
        $this->achevee = $achevee;

        return $this;
    }

    /**
     * @return Collection<int, Batiment>
     */
    public function getBatiements(): Collection
    {
        return $this->batiements;
    }

    public function addBatiement(Batiment $batiement): static
    {
        if (!$this->batiements->contains($batiement)) {
            $this->batiements->add($batiement);
            $batiement->setAnnee($this);
        }

        return $this;
    }

    public function removeBatiement(Batiment $batiement): static
    {
        if ($this->batiements->removeElement($batiement)) {
            // set the owning side to null (unless already changed)
            if ($batiement->getAnnee() === $this) {
                $batiement->setAnnee(null);
            }
        }

        return $this;
    }
}
