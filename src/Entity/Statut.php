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
     * @var Collection<int, LesParent>
     */
    #[ORM\OneToMany(targetEntity: LesParent::class, mappedBy: 'Statut_parent')]
    private Collection $lesParents;

    public function __construct()
    {
        $this->lesParents = new ArrayCollection();
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
     * @return Collection<int, LesParent>
     */
    public function getLesParents(): Collection
    {
        return $this->lesParents;
    }

    public function addLesParent(LesParent $lesParent): static
    {
        if (!$this->lesParents->contains($lesParent)) {
            $this->lesParents->add($lesParent);
            $lesParent->setStatutParent($this);
        }

        return $this;
    }

    public function removeLesParent(LesParent $lesParent): static
    {
        if ($this->lesParents->removeElement($lesParent)) {
            // set the owning side to null (unless already changed)
            if ($lesParent->getStatutParent() === $this) {
                $lesParent->setStatutParent(null);
            }
        }

        return $this;
    }
}
