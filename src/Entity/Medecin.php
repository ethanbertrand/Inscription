<?php

namespace App\Entity;

use App\Repository\MedecinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedecinRepository::class)]
class Medecin
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
    private ?int $Tel = null;

    /**
     * @var Collection<int, Eleve>
     */
    #[ORM\OneToMany(targetEntity: Eleve::class, mappedBy: 'medecin')]
    private Collection $medecin_eleve;

    public function __construct()
    {
        $this->medecin_eleve = new ArrayCollection();
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

    public function getTel(): ?int
    {
        return $this->Tel;
    }

    public function setTel(int $Tel): static
    {
        $this->Tel = $Tel;

        return $this;
    }

    /**
     * @return Collection<int, Eleve>
     */
    public function getMedecinEleve(): Collection
    {
        return $this->medecin_eleve;
    }

    public function addMedecinEleve(Eleve $medecinEleve): static
    {
        if (!$this->medecin_eleve->contains($medecinEleve)) {
            $this->medecin_eleve->add($medecinEleve);
            $medecinEleve->setMedecin($this);
        }

        return $this;
    }

    public function removeMedecinEleve(Eleve $medecinEleve): static
    {
        if ($this->medecin_eleve->removeElement($medecinEleve)) {
            // set the owning side to null (unless already changed)
            if ($medecinEleve->getMedecin() === $this) {
                $medecinEleve->setMedecin(null);
            }
        }

        return $this;
    }
}
