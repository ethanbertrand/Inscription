<?php

namespace App\Entity;

use App\Repository\LangueEleveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LangueEleveRepository::class)]
class LangueEleve
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Langue>
     */
    #[ORM\OneToMany(targetEntity: Langue::class, mappedBy: 'langueEleve')]
    private Collection $id_langue;

    /**
     * @var Collection<int, Eleve>
     */
    #[ORM\OneToMany(targetEntity: Eleve::class, mappedBy: 'langueEleve')]
    private Collection $id_eleve;

    public function __construct()
    {
        $this->id_langue = new ArrayCollection();
        $this->id_eleve = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Langue>
     */
    public function getIdLangue(): Collection
    {
        return $this->id_langue;
    }

    public function addIdLangue(Langue $idLangue): static
    {
        if (!$this->id_langue->contains($idLangue)) {
            $this->id_langue->add($idLangue);
            $idLangue->setLangueEleve($this);
        }

        return $this;
    }

    public function removeIdLangue(Langue $idLangue): static
    {
        if ($this->id_langue->removeElement($idLangue)) {
            // set the owning side to null (unless already changed)
            if ($idLangue->getLangueEleve() === $this) {
                $idLangue->setLangueEleve(null);
            }
        }

        return $this;
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
            $idEleve->setLangueEleve($this);
        }

        return $this;
    }

    public function removeIdEleve(Eleve $idEleve): static
    {
        if ($this->id_eleve->removeElement($idEleve)) {
            // set the owning side to null (unless already changed)
            if ($idEleve->getLangueEleve() === $this) {
                $idEleve->setLangueEleve(null);
            }
        }

        return $this;
    }
}
