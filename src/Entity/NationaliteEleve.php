<?php

namespace App\Entity;

use App\Repository\NationaliteEleveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NationaliteEleveRepository::class)]
class NationaliteEleve
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Nationalite>
     */
    #[ORM\OneToMany(targetEntity: Nationalite::class, mappedBy: 'nationaliteEleve')]
    private Collection $id_nationalite;

    /**
     * @var Collection<int, Eleve>
     */
    #[ORM\OneToMany(targetEntity: Eleve::class, mappedBy: 'nationaliteEleve')]
    private Collection $id_eleve;

    public function __construct()
    {
        $this->id_nationalite = new ArrayCollection();
        $this->id_eleve = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Nationalite>
     */
    public function getIdNationalite(): Collection
    {
        return $this->id_nationalite;
    }

    public function addIdNationalite(Nationalite $idNationalite): static
    {
        if (!$this->id_nationalite->contains($idNationalite)) {
            $this->id_nationalite->add($idNationalite);
            $idNationalite->setNationaliteEleve($this);
        }

        return $this;
    }

    public function removeIdNationalite(Nationalite $idNationalite): static
    {
        if ($this->id_nationalite->removeElement($idNationalite)) {
            // set the owning side to null (unless already changed)
            if ($idNationalite->getNationaliteEleve() === $this) {
                $idNationalite->setNationaliteEleve(null);
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
            $idEleve->setNationaliteEleve($this);
        }

        return $this;
    }

    public function removeIdEleve(Eleve $idEleve): static
    {
        if ($this->id_eleve->removeElement($idEleve)) {
            // set the owning side to null (unless already changed)
            if ($idEleve->getNationaliteEleve() === $this) {
                $idEleve->setNationaliteEleve(null);
            }
        }

        return $this;
    }
}
