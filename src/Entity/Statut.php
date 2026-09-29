<?php

namespace App\Entity;

use App\Repository\StatutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatutRepository::class)]
class Statut
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Libelle = null;

    /**
     * @var Collection<int, Parents>
     */
    #[ORM\OneToMany(targetEntity: Parents::class, mappedBy: 'statut')]
    private Collection $statut_parents;

    public function __construct()
    {
        $this->statut_parents = new ArrayCollection();
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
     * @return Collection<int, Parents>
     */
    public function getStatutParents(): Collection
    {
        return $this->statut_parents;
    }

    public function addStatutParent(Parents $statutParent): static
    {
        if (!$this->statut_parents->contains($statutParent)) {
            $this->statut_parents->add($statutParent);
            $statutParent->setStatut($this);
        }

        return $this;
    }

    public function removeStatutParent(Parents $statutParent): static
    {
        if ($this->statut_parents->removeElement($statutParent)) {
            // set the owning side to null (unless already changed)
            if ($statutParent->getStatut() === $this) {
                $statutParent->setStatut(null);
            }
        }

        return $this;
    }
}
