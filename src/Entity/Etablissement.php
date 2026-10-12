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
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Adresse = null;

    #[ORM\ManyToOne(inversedBy: 'etablissements')]
    private ?Commune $Etablissement_commune = null;

    /**
     * @var Collection<int, AnneeAnterieur>
     */
    #[ORM\OneToMany(targetEntity: AnneeAnterieur::class, mappedBy: 'annee_eleve')]
    private Collection $anneeAnterieurs;

    public function __construct()
    {
        $this->anneeAnterieurs = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): static
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getEtablissementCommune(): ?Commune
    {
        return $this->Etablissement_commune;
    }

    public function setEtablissementCommune(?Commune $Etablissement_commune): static
    {
        $this->Etablissement_commune = $Etablissement_commune;

        return $this;
    }

    /**
     * @return Collection<int, AnneeAnterieur>
     */
    public function getAnneeAnterieurs(): Collection
    {
        return $this->anneeAnterieurs;
    }

    public function addAnneeAnterieur(AnneeAnterieur $anneeAnterieur): static
    {
        if (!$this->anneeAnterieurs->contains($anneeAnterieur)) {
            $this->anneeAnterieurs->add($anneeAnterieur);
            $anneeAnterieur->setAnneeEleve($this);
        }

        return $this;
    }

    public function removeAnneeAnterieur(AnneeAnterieur $anneeAnterieur): static
    {
        if ($this->anneeAnterieurs->removeElement($anneeAnterieur)) {
            // set the owning side to null (unless already changed)
            if ($anneeAnterieur->getAnneeEleve() === $this) {
                $anneeAnterieur->setAnneeEleve(null);
            }
        }

        return $this;
    }
}
