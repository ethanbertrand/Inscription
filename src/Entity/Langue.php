<?php

namespace App\Entity;

use App\Repository\LangueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LangueRepository::class)]
class Langue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Libelle = null;

    #[ORM\Column(length: 255)]
    private ?string $lv = null;

    /**
     * @var Collection<int, AnneeAnterieur>
     */
    #[ORM\OneToMany(targetEntity: AnneeAnterieur::class, mappedBy: 'langue')]
    private Collection $lv1;

    /**
     * @var Collection<int, AnneeAnterieur>
     */
    #[ORM\OneToMany(targetEntity: AnneeAnterieur::class, mappedBy: 'langue')]
    private Collection $lv2;

    /**
     * @var Collection<int, Eleve>
     */
    #[ORM\ManyToMany(targetEntity: Eleve::class, mappedBy: 'langueeleve')]
    private Collection $eleves;

    public function __construct()
    {
        $this->lv1 = new ArrayCollection();
        $this->lv2 = new ArrayCollection();
        $this->eleves = new ArrayCollection();
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

    public function getLv(): ?string
    {
        return $this->lv;
    }

    public function setLv(string $lv): static
    {
        $this->lv = $lv;

        return $this;
    }

    /**
     * @return Collection<int, AnneeAnterieur>
     */
    public function getLv1(): Collection
    {
        return $this->lv1;
    }

    public function addLv1(AnneeAnterieur $lv1): static
    {
        if (!$this->lv1->contains($lv1)) {
            $this->lv1->add($lv1);
            $lv1->setLangue($this);
        }

        return $this;
    }

    public function removeLv1(AnneeAnterieur $lv1): static
    {
        if ($this->lv1->removeElement($lv1)) {
            // set the owning side to null (unless already changed)
            if ($lv1->getLangue() === $this) {
                $lv1->setLangue(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AnneeAnterieur>
     */
    public function getLv2(): Collection
    {
        return $this->lv2;
    }

    public function addLv2(AnneeAnterieur $lv2): static
    {
        if (!$this->lv2->contains($lv2)) {
            $this->lv2->add($lv2);
            $lv2->setLangue($this);
        }

        return $this;
    }

    public function removeLv2(AnneeAnterieur $lv2): static
    {
        if ($this->lv2->removeElement($lv2)) {
            // set the owning side to null (unless already changed)
            if ($lv2->getLangue() === $this) {
                $lv2->setLangue(null);
            }
        }

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
            $elefe->addLangueeleve($this);
        }

        return $this;
    }

    public function removeElefe(Eleve $elefe): static
    {
        if ($this->eleves->removeElement($elefe)) {
            $elefe->removeLangueeleve($this);
        }

        return $this;
    }
}
