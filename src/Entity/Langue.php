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

    #[ORM\ManyToOne(inversedBy: 'id_langue')]
    private ?LangueEleve $langueEleve = null;

    /**
     * @var Collection<int, AnneeAnterieur>
     */
    #[ORM\OneToMany(targetEntity: AnneeAnterieur::class, mappedBy: 'langue1')]
    private Collection $anneeAnterieurs;

    public function __construct()
    {
        $this->anneeAnterieurs = new ArrayCollection();
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

    public function getLv(): ?string
    {
        return $this->lv;
    }

    public function setLv(string $lv): static
    {
        $this->lv = $lv;

        return $this;
    }

    public function getLangueEleve(): ?LangueEleve
    {
        return $this->langueEleve;
    }

    public function setLangueEleve(?LangueEleve $langueEleve): static
    {
        $this->langueEleve = $langueEleve;

        return $this;
    }

    /**
     * @return Collection<int, AnneeAnterieur>
     */
    public function getAnneeAnterieurs(): Collection
    {
        return $this->anneeAnterieurs;
    }

    public function addAnneeAnterieur(AnneeAnterieur $anneeAnterieur): static
    {
        if (!$this->anneeAnterieurs->contains($anneeAnterieur)) {
            $this->anneeAnterieurs->add($anneeAnterieur);
            $anneeAnterieur->setLangue1($this);
        }

        return $this;
    }

    public function removeAnneeAnterieur(AnneeAnterieur $anneeAnterieur): static
    {
        if ($this->anneeAnterieurs->removeElement($anneeAnterieur)) {
            // set the owning side to null (unless already changed)
            if ($anneeAnterieur->getLangue1() === $this) {
                $anneeAnterieur->setLangue1(null);
            }
        }

        return $this;
    }
}
