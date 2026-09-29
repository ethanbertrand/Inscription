<?php

namespace App\Entity;

use App\Repository\ParentsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParentsRepository::class)]
class Parents
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $Adresse = null;

    #[ORM\Column]
    private ?int $tel_fixe = null;

    #[ORM\Column]
    private ?int $tel_portable = null;

    #[ORM\Column]
    private ?int $tel_entreprise = null;

    #[ORM\Column(length: 255)]
    private ?string $Poste = null;

    #[ORM\ManyToOne(inversedBy: 'no')]
    private ?Statut $statut_parents = null;

    #[ORM\ManyToOne(inversedBy: 'statut_parents')]
    private ?Statut $statut = null;

    #[ORM\ManyToOne(inversedBy: 'id_parents')]
    private ?ParentsEleve $parentsEleve = null;

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

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

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

    public function getTelFixe(): ?int
    {
        return $this->tel_fixe;
    }

    public function setTelFixe(int $tel_fixe): static
    {
        $this->tel_fixe = $tel_fixe;

        return $this;
    }

    public function getTelPortable(): ?int
    {
        return $this->tel_portable;
    }

    public function setTelPortable(int $tel_portable): static
    {
        $this->tel_portable = $tel_portable;

        return $this;
    }

    public function getTelEntreprise(): ?int
    {
        return $this->tel_entreprise;
    }

    public function setTelEntreprise(int $tel_entreprise): static
    {
        $this->tel_entreprise = $tel_entreprise;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->Poste;
    }

    public function setPoste(string $Poste): static
    {
        $this->Poste = $Poste;

        return $this;
    }

    public function getStatutParents(): ?Statut
    {
        return $this->statut_parents;
    }

    public function setStatutParents(?Statut $statut_parents): static
    {
        $this->statut_parents = $statut_parents;

        return $this;
    }

    public function getStatut(): ?Statut
    {
        return $this->statut;
    }

    public function setStatut(?Statut $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getParentsEleve(): ?ParentsEleve
    {
        return $this->parentsEleve;
    }

    public function setParentsEleve(?ParentsEleve $parentsEleve): static
    {
        $this->parentsEleve = $parentsEleve;

        return $this;
    }
}
