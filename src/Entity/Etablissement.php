<?php

namespace App\Entity;

use App\Repository\EtablissementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtablissementRepository::class)]
class Etablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Adresse = null;

    #[ORM\ManyToOne(inversedBy: 'etablissements')]
    private ?Commune $commune_etablissement = null;

    /**
     * @var Collection<int, AnneeAnterieur>
     */
    #[ORM\OneToMany(targetEntity: AnneeAnterieur::class, mappedBy: 'etablissement')]
    private Collection $annee_etablissment;

    public function __construct()
    {
        $this->annee_etablissment = new ArrayCollection();
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

    public function getCommuneEtablissement(): ?Commune
    {
        return $this->commune_etablissement;
    }

    public function setCommuneEtablissement(?Commune $commune_etablissement): static
    {
        $this->commune_etablissement = $commune_etablissement;

        return $this;
    }

    /**
     * @return Collection<int, AnneeAnterieur>
     */
    public function getAnneeEtablissment(): Collection
    {
        return $this->annee_etablissment;
    }

    public function addAnneeEtablissment(AnneeAnterieur $anneeEtablissment): static
    {
        if (!$this->annee_etablissment->contains($anneeEtablissment)) {
            $this->annee_etablissment->add($anneeEtablissment);
            $anneeEtablissment->setEtablissement($this);
        }

        return $this;
    }

    public function removeAnneeEtablissment(AnneeAnterieur $anneeEtablissment): static
    {
        if ($this->annee_etablissment->removeElement($anneeEtablissment)) {
            // set the owning side to null (unless already changed)
            if ($anneeEtablissment->getEtablissement() === $this) {
                $anneeEtablissment->setEtablissement(null);
            }
        }

        return $this;
    }
}
