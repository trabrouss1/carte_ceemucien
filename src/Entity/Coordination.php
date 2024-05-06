<?php

namespace App\Entity;

use App\Repository\CoordinationRepository;
use App\Trait\addFilesCDUTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: CoordinationRepository::class)]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false, hardDelete: true)]
class Coordination
{
    use addFilesCDUTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $localite = null;

    #[ORM\Column(length: 255)]
    private ?string $president = null;

    /**
     * @var Collection<int, Membre>
     */
    #[ORM\OneToMany(targetEntity: Membre::class, mappedBy: 'coordination')]
    private Collection $membres;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nombreMembre = null;

    /**
     * @var Collection<int, Seminariste>
     */
    #[ORM\OneToMany(targetEntity: Seminariste::class, mappedBy: 'coordination')]
    private Collection $seminaristes;

    public function __construct()
    {
        $this->membres = new ArrayCollection();
        $this->seminaristes = new ArrayCollection();
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

    public function getLocalite(): ?string
    {
        return $this->localite;
    }

    public function setLocalite(string $localite): static
    {
        $this->localite = $localite;

        return $this;
    }

    public function getPresident(): ?string
    {
        return $this->president;
    }

    public function setPresident(string $president): static
    {
        $this->president = $president;

        return $this;
    }

    /**
     * @return Collection<int, Membre>
     */
    public function getMembres(): Collection
    {
        return $this->membres;
    }

    public function addMembre(Membre $membre): static
    {
        if (!$this->membres->contains($membre)) {
            $this->membres->add($membre);
            $membre->setCoordination($this);
        }

        return $this;
    }

    public function removeMembre(Membre $membre): static
    {
        if ($this->membres->removeElement($membre)) {
            // set the owning side to null (unless already changed)
            if ($membre->getCoordination() === $this) {
                $membre->setCoordination(null);
            }
        }

        return $this;
    }

    public function getNombreMembre(): ?string
    {
        return $this->nombreMembre;
    }

    public function setNombreMembre(?string $nombreMembre): static
    {
        $this->nombreMembre = $nombreMembre;

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
            $seminariste->setCoordination($this);
        }

        return $this;
    }

    public function removeSeminariste(Seminariste $seminariste): static
    {
        if ($this->seminaristes->removeElement($seminariste)) {
            // set the owning side to null (unless already changed)
            if ($seminariste->getCoordination() === $this) {
                $seminariste->setCoordination(null);
            }
        }

        return $this;
    }
}
