<?php

namespace App\Entity;

use App\Repository\AssuranceScolaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssuranceScolaireRepository::class)]
class AssuranceScolaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Adresse = null;

    /**
     * @var Collection<int, Eleve>
     */
    #[ORM\OneToMany(targetEntity: Eleve::class, mappedBy: 'assuranceScolaire')]
    private Collection $assurance_eleve;

    public function __construct()
    {
        $this->assurance_eleve = new ArrayCollection();
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

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): static
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    /**
     * @return Collection<int, Eleve>
     */
    public function getAssuranceEleve(): Collection
    {
        return $this->assurance_eleve;
    }

    public function addAssuranceEleve(Eleve $assuranceEleve): static
    {
        if (!$this->assurance_eleve->contains($assuranceEleve)) {
            $this->assurance_eleve->add($assuranceEleve);
            $assuranceEleve->setAssuranceScolaire($this);
        }

        return $this;
    }

    public function removeAssuranceEleve(Eleve $assuranceEleve): static
    {
        if ($this->assurance_eleve->removeElement($assuranceEleve)) {
            // set the owning side to null (unless already changed)
            if ($assuranceEleve->getAssuranceScolaire() === $this) {
                $assuranceEleve->setAssuranceScolaire(null);
            }
        }

        return $this;
    }
}
