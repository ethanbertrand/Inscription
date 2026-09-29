<?php

namespace App\Entity;

use App\Repository\MDLRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MDLRepository::class)]
class MDL
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $cheque = null;

    #[ORM\Column]
    private ?bool $photo = null;

    #[ORM\Column]
    private ?bool $affichage = null;

    #[ORM\Column]
    private ?bool $adhesion = null;

    /**
     * @var Collection<int, Eleve>
     */
    #[ORM\OneToMany(targetEntity: Eleve::class, mappedBy: 'mDL')]
    private Collection $mdl_eleve;

    public function __construct()
    {
        $this->mdl_eleve = new ArrayCollection();
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

    public function isCheque(): ?bool
    {
        return $this->cheque;
    }

    public function setCheque(bool $cheque): static
    {
        $this->cheque = $cheque;

        return $this;
    }

    public function isPhoto(): ?bool
    {
        return $this->photo;
    }

    public function setPhoto(bool $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function isAffichage(): ?bool
    {
        return $this->affichage;
    }

    public function setAffichage(bool $affichage): static
    {
        $this->affichage = $affichage;

        return $this;
    }

    public function isAdhesion(): ?bool
    {
        return $this->adhesion;
    }

    public function setAdhesion(bool $adhesion): static
    {
        $this->adhesion = $adhesion;

        return $this;
    }

    /**
     * @return Collection<int, Eleve>
     */
    public function getMdlEleve(): Collection
    {
        return $this->mdl_eleve;
    }

    public function addMdlEleve(Eleve $mdlEleve): static
    {
        if (!$this->mdl_eleve->contains($mdlEleve)) {
            $this->mdl_eleve->add($mdlEleve);
            $mdlEleve->setMDL($this);
        }

        return $this;
    }

    public function removeMdlEleve(Eleve $mdlEleve): static
    {
        if ($this->mdl_eleve->removeElement($mdlEleve)) {
            // set the owning side to null (unless already changed)
            if ($mdlEleve->getMDL() === $this) {
                $mdlEleve->setMDL(null);
            }
        }

        return $this;
    }
}
