<?php

namespace App\Entity;

use App\Repository\MDLRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MDLRepository::class)]
class MDL
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Cheque = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Photo = null;

    #[ORM\Column]
    private ?bool $Adhesion = null;

    /**
     * @var Collection<int, Eleve>
     */
    #[ORM\OneToMany(targetEntity: Eleve::class, mappedBy: 'mdl_eleve')]
    private Collection $eleves;

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCheque(): ?string
    {
        return $this->Cheque;
    }

    public function setCheque(?string $Cheque): static
    {
        $this->Cheque = $Cheque;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->Photo;
    }

    public function setPhoto(?string $Photo): static
    {
        $this->Photo = $Photo;

        return $this;
    }

    public function isAdhesion(): ?bool
    {
        return $this->Adhesion;
    }

    public function setAdhesion(bool $Adhesion): static
    {
        $this->Adhesion = $Adhesion;

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
            $elefe->setMdlEleve($this);
        }

        return $this;
    }

    public function removeElefe(Eleve $elefe): static
    {
        if ($this->eleves->removeElement($elefe)) {
            // set the owning side to null (unless already changed)
            if ($elefe->getMdlEleve() === $this) {
                $elefe->setMdlEleve(null);
            }
        }

        return $this;
    }
}
