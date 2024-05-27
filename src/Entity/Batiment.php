<?php

namespace App\Entity;

use App\Repository\BatimentRepository;
use App\Trait\addFilesCDUTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false, hardDelete: true)]
#[ORM\Entity(repositoryClass: BatimentRepository::class)]
class Batiment
{
    use addFilesCDUTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    #[ORM\ManyToOne(inversedBy: 'batiements')]
    private ?Annee $annee = null;

    /**
     * @var Collection<int, Dortoirs>
     */
    #[ORM\OneToMany(targetEntity: Dortoirs::class, mappedBy: 'batiment')]
    private Collection $dortoirs;

    public function __construct()
    {
        $this->dortoirs = new ArrayCollection();
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

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

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

    /**
     * @return Collection<int, Dortoirs>
     */
    public function getDortoirs(): Collection
    {
        return $this->dortoirs;
    }

    public function addDortoir(Dortoirs $dortoir): static
    {
        if (!$this->dortoirs->contains($dortoir)) {
            $this->dortoirs->add($dortoir);
            $dortoir->setBatiment($this);
        }

        return $this;
    }

    public function removeDortoir(Dortoirs $dortoir): static
    {
        if ($this->dortoirs->removeElement($dortoir)) {
            // set the owning side to null (unless already changed)
            if ($dortoir->getBatiment() === $this) {
                $dortoir->setBatiment(null);
            }
        }

        return $this;
    }
}
