<?php

namespace App\Entity;

use App\Repository\DepartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartementRepository::class)]
class Departement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Libelle = null;

    /**
     * @var Collection<int, Commune>
     */
    #[ORM\OneToMany(targetEntity: Commune::class, mappedBy: 'departement')]
    private Collection $departement_commune;

    public function __construct()
    {
        $this->departement_commune = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Commune>
     */
    public function getDepartementCommune(): Collection
    {
        return $this->departement_commune;
    }

    public function addDepartementCommune(Commune $departementCommune): static
    {
        if (!$this->departement_commune->contains($departementCommune)) {
            $this->departement_commune->add($departementCommune);
            $departementCommune->setDepartement($this);
        }

        return $this;
    }

    public function removeDepartementCommune(Commune $departementCommune): static
    {
        if ($this->departement_commune->removeElement($departementCommune)) {
            // set the owning side to null (unless already changed)
            if ($departementCommune->getDepartement() === $this) {
                $departementCommune->setDepartement(null);
            }
        }

        return $this;
    }
}
