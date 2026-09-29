<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Libelle = null;

    /**
     * @var Collection<int, Eleve>
     */
    #[ORM\OneToMany(targetEntity: Eleve::class, mappedBy: 'classe')]
    private Collection $classe_eleve;

    public function __construct()
    {
        $this->classe_eleve = new ArrayCollection();
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
     * @return Collection<int, Eleve>
     */
    public function getClasseEleve(): Collection
    {
        return $this->classe_eleve;
    }

    public function addClasseEleve(Eleve $classeEleve): static
    {
        if (!$this->classe_eleve->contains($classeEleve)) {
            $this->classe_eleve->add($classeEleve);
            $classeEleve->setClasse($this);
        }

        return $this;
    }

    public function removeClasseEleve(Eleve $classeEleve): static
    {
        if ($this->classe_eleve->removeElement($classeEleve)) {
            // set the owning side to null (unless already changed)
            if ($classeEleve->getClasse() === $this) {
                $classeEleve->setClasse(null);
            }
        }

        return $this;
    }
}
