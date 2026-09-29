<?php

namespace App\Entity;

use App\Repository\CommuneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommuneRepository::class)]
class Commune
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\ManyToOne(inversedBy: 'departement_commune')]
    private ?Departement $departement = null;

    /**
     * @var Collection<int, Eleve>
     */
    #[ORM\OneToMany(targetEntity: Eleve::class, mappedBy: 'commune')]
    private Collection $Commune_eleve;

    /**
     * @var Collection<int, Etablissement>
     */
    #[ORM\OneToMany(targetEntity: Etablissement::class, mappedBy: 'commune_etablissement')]
    private Collection $etablissements;

    public function __construct()
    {
        $this->Commune_eleve = new ArrayCollection();
        $this->etablissements = new ArrayCollection();
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

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): static
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * @return Collection<int, Eleve>
     */
    public function getCommuneEleve(): Collection
    {
        return $this->Commune_eleve;
    }

    public function addCommuneEleve(Eleve $communeEleve): static
    {
        if (!$this->Commune_eleve->contains($communeEleve)) {
            $this->Commune_eleve->add($communeEleve);
            $communeEleve->setCommune($this);
        }

        return $this;
    }

    public function removeCommuneEleve(Eleve $communeEleve): static
    {
        if ($this->Commune_eleve->removeElement($communeEleve)) {
            // set the owning side to null (unless already changed)
            if ($communeEleve->getCommune() === $this) {
                $communeEleve->setCommune(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Etablissement>
     */
    public function getEtablissements(): Collection
    {
        return $this->etablissements;
    }

    public function addEtablissement(Etablissement $etablissement): static
    {
        if (!$this->etablissements->contains($etablissement)) {
            $this->etablissements->add($etablissement);
            $etablissement->setCommuneEtablissement($this);
        }

        return $this;
    }

    public function removeEtablissement(Etablissement $etablissement): static
    {
        if ($this->etablissements->removeElement($etablissement)) {
            // set the owning side to null (unless already changed)
            if ($etablissement->getCommuneEtablissement() === $this) {
                $etablissement->setCommuneEtablissement(null);
            }
        }

        return $this;
    }
}
