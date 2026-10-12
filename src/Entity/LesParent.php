<?php

namespace App\Entity;

use App\Repository\LesParentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LesParentRepository::class)]
class LesParent
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
    private ?int $Tel_portable = null;

    #[ORM\Column]
    private ?int $Tel_fixe = null;

    #[ORM\Column]
    private ?int $Tel_entreprise = null;

    #[ORM\Column(length: 255)]
    private ?string $Poste = null;

    #[ORM\ManyToOne(inversedBy: 'lesParents')]
    private ?Statut $Statut_parent = null;

    /**
     * @var Collection<int, Eleve>
     */
    #[ORM\ManyToMany(targetEntity: Eleve::class, mappedBy: 'parent_eleve')]
    private Collection $eleves;

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTelPortable(): ?int
    {
        return $this->Tel_portable;
    }

    public function setTelPortable(int $Tel_portable): static
    {
        $this->Tel_portable = $Tel_portable;

        return $this;
    }

    public function getTelFixe(): ?int
    {
        return $this->Tel_fixe;
    }

    public function setTelFixe(int $Tel_fixe): static
    {
        $this->Tel_fixe = $Tel_fixe;

        return $this;
    }

    public function getTelEntreprise(): ?int
    {
        return $this->Tel_entreprise;
    }

    public function setTelEntreprise(int $Tel_entreprise): static
    {
        $this->Tel_entreprise = $Tel_entreprise;

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

    public function getStatutParent(): ?Statut
    {
        return $this->Statut_parent;
    }

    public function setStatutParent(?Statut $Statut_parent): static
    {
        $this->Statut_parent = $Statut_parent;

        return $this;
    }

    /**
     * @return Collection<int, Eleve>
     */
    public function getEleves(): Collection
    {
        return $this->eleves;
    }

    public function addElefe(Eleve $elefe): static
    {
        if (!$this->eleves->contains($elefe)) {
            $this->eleves->add($elefe);
            $elefe->addParentEleve($this);
        }

        return $this;
    }

    public function removeElefe(Eleve $elefe): static
    {
        if ($this->eleves->removeElement($elefe)) {
            $elefe->removeParentEleve($this);
        }

        return $this;
    }
}
