<?php

namespace App\Entity;

use App\Repository\ParentsEleveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParentsEleveRepository::class)]
class ParentsEleve
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Eleve>
     */
    #[ORM\OneToMany(targetEntity: Eleve::class, mappedBy: 'parentsEleve')]
    private Collection $id_eleve;

    /**
     * @var Collection<int, Parents>
     */
    #[ORM\OneToMany(targetEntity: Parents::class, mappedBy: 'parentsEleve')]
    private Collection $id_parents;

    public function __construct()
    {
        $this->id_eleve = new ArrayCollection();
        $this->id_parents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Eleve>
     */
    public function getIdEleve(): Collection
    {
        return $this->id_eleve;
    }

    public function addIdEleve(Eleve $idEleve): static
    {
        if (!$this->id_eleve->contains($idEleve)) {
            $this->id_eleve->add($idEleve);
            $idEleve->setParentsEleve($this);
        }

        return $this;
    }

    public function removeIdEleve(Eleve $idEleve): static
    {
        if ($this->id_eleve->removeElement($idEleve)) {
            // set the owning side to null (unless already changed)
            if ($idEleve->getParentsEleve() === $this) {
                $idEleve->setParentsEleve(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Parents>
     */
    public function getIdParents(): Collection
    {
        return $this->id_parents;
    }

    public function addIdParent(Parents $idParent): static
    {
        if (!$this->id_parents->contains($idParent)) {
            $this->id_parents->add($idParent);
            $idParent->setParentsEleve($this);
        }

        return $this;
    }

    public function removeIdParent(Parents $idParent): static
    {
        if ($this->id_parents->removeElement($idParent)) {
            // set the owning side to null (unless already changed)
            if ($idParent->getParentsEleve() === $this) {
                $idParent->setParentsEleve(null);
            }
        }

        return $this;
    }
}
