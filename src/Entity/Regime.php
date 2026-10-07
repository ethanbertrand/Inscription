<?php

namespace App\Entity;

use App\Repository\RegimeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegimeRepository::class)]
class Regime
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Regime = null;

    /**
     * @var Collection<int, Eleve>
     */
    #[ORM\OneToMany(targetEntity: Eleve::class, mappedBy: 'regime')]
    private Collection $regime_eleve;

    public function __construct()
    {
        $this->regime_eleve = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getRegime(): ?string
    {
        return $this->Regime;
    }

    public function getNom(): ?string
    {
        return $this->Regime;
    }

    public function setRegime(string $Regime): static
    {
        $this->Regime = $Regime;

        return $this;
    }

    public function setNom(string $Nom): static
    {
        $this->Regime = $Nom;

        return $this;
    }

    /**
     * @return Collection<int, Eleve>
     */
    public function getRegimeEleve(): Collection
    {
        return $this->regime_eleve;
    }

    public function addRegimeEleve(Eleve $regimeEleve): static
    {
        if (!$this->regime_eleve->contains($regimeEleve)) {
            $this->regime_eleve->add($regimeEleve);
            $regimeEleve->setRegime($this);
        }

        return $this;
    }

    public function removeRegimeEleve(Eleve $regimeEleve): static
    {
        if ($this->regime_eleve->removeElement($regimeEleve)) {
            // set the owning side to null (unless already changed)
            if ($regimeEleve->getRegime() === $this) {
                $regimeEleve->setRegime(null);
            }
        }

        return $this;
    }
}
