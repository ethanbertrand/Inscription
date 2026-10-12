<?php

namespace App\Entity;

use App\Repository\AnneeAnterieurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnneeAnterieurRepository::class)]
class AnneeAnterieur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $Annee = null;

    #[ORM\Column(length: 255)]
    private ?string $Classe = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $une_option = null;

    #[ORM\ManyToOne(inversedBy: 'anneeAnterieurs')]
    private ?Etablissement $annee_eleve = null;

    #[ORM\ManyToOne(inversedBy: 'lv1')]
    private ?Langue $langue = null;

    /**
     * @var Collection<int, Eleve>
     */
    #[ORM\OneToMany(targetEntity: Eleve::class, mappedBy: 'annee_anterieur_eleve')]
    private Collection $eleves;

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?\DateTime
    {
        return $this->Annee;
    }

    public function setAnnee(\DateTime $Annee): static
    {
        $this->Annee = $Annee;

        return $this;
    }

    public function getClasse(): ?string
    {
        return $this->Classe;
    }

    public function setClasse(string $Classe): static
    {
        $this->Classe = $Classe;

        return $this;
    }

    public function getUneOption(): ?string
    {
        return $this->une_option;
    }

    public function setUneOption(?string $une_option): static
    {
        $this->une_option = $une_option;

        return $this;
    }

    public function getAnneeEleve(): ?Etablissement
    {
        return $this->annee_eleve;
    }

    public function setAnneeEleve(?Etablissement $annee_eleve): static
    {
        $this->annee_eleve = $annee_eleve;

        return $this;
    }

    public function getLangue(): ?Langue
    {
        return $this->langue;
    }

    public function setLangue(?Langue $langue): static
    {
        $this->langue = $langue;

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
            $elefe->setAnneeAnterieurEleve($this);
        }

        return $this;
    }

    public function removeElefe(Eleve $elefe): static
    {
        if ($this->eleves->removeElement($elefe)) {
            // set the owning side to null (unless already changed)
            if ($elefe->getAnneeAnterieurEleve() === $this) {
                $elefe->setAnneeAnterieurEleve(null);
            }
        }

        return $this;
    }
}
