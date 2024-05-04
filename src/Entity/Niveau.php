<?php

namespace App\Entity;

use App\Repository\NiveauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NiveauRepository::class)]
class Niveau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, Membre>
     */
    #[ORM\OneToMany(targetEntity: Membre::class, mappedBy: 'niveau')]
    private Collection $membres;

    public function __construct()
    {
        $this->membres = new ArrayCollection();
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
            $membre->setNiveau($this);
        }

        return $this;
    }

    public function removeMembre(Membre $membre): static
    {
        if ($this->membres->removeElement($membre)) {
            // set the owning side to null (unless already changed)
            if ($membre->getNiveau() === $this) {
                $membre->setNiveau(null);
            }
        }

        return $this;
    }
}
