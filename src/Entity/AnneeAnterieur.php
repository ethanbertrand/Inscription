<?php

namespace App\Entity;

use App\Repository\AnneeAnterieurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnneeAnterieurRepository::class)]
class AnneeAnterieur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $annee = null;

    #[ORM\Column(length: 255)]
    private ?string $Classe = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $uneoption = null;

    #[ORM\ManyToOne(inversedBy: 'anneeAnterieurs')]
    private ?Langue $langue1 = null;

    #[ORM\ManyToOne(inversedBy: 'anneeAnterieurs')]
    private ?Langue $langue2 = null;

    #[ORM\ManyToOne(inversedBy: 'anneeAnterieurs')]
    private ?eleve $annee_eleve = null;

    #[ORM\ManyToOne(inversedBy: 'annee_etablissment')]
    private ?Etablissement $etablissement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getClasse(): ?string
    {
        return $this->Classe;
    }

    public function setClasse(string $Classe): static
    {
        $this->Classe = $Classe;

        return $this;
    }

    public function getUneoption(): ?string
    {
        return $this->uneoption;
    }

    public function setUneoption(?string $uneoption): static
    {
        $this->uneoption = $uneoption;

        return $this;
    }

    public function getLangue1(): ?Langue
    {
        return $this->langue1;
    }

    public function setLangue1(?Langue $langue1): static
    {
        $this->langue1 = $langue1;

        return $this;
    }

    public function getLangue2(): ?Langue
    {
        return $this->langue2;
    }

    public function setLangue2(?Langue $langue2): static
    {
        $this->langue2 = $langue2;

        return $this;
    }

    public function getAnneeEleve(): ?eleve
    {
        return $this->annee_eleve;
    }

    public function setAnneeEleve(?eleve $annee_eleve): static
    {
        $this->annee_eleve = $annee_eleve;

        return $this;
    }

    public function getEtablissement(): ?Etablissement
    {
        return $this->etablissement;
    }

    public function setEtablissement(?Etablissement $etablissement): static
    {
        $this->etablissement = $etablissement;

        return $this;
    }
}
