<?php

namespace App\Entity;

use App\Repository\CentreSecuriteSocialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CentreSecuriteSocialRepository::class)]
class CentreSecuriteSocial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Adresse = null;

    /**
     * @var Collection<int, Eleve>
     */
    #[ORM\OneToMany(targetEntity: Eleve::class, mappedBy: 'centreSecuriteSocial')]
    private Collection $eleve_secu_social;

    public function __construct()
    {
        $this->eleve_secu_social = new ArrayCollection();
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

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): static
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    /**
     * @return Collection<int, Eleve>
     */
    public function getEleveSecuSocial(): Collection
    {
        return $this->eleve_secu_social;
    }

    public function addEleveSecuSocial(Eleve $eleveSecuSocial): static
    {
        if (!$this->eleve_secu_social->contains($eleveSecuSocial)) {
            $this->eleve_secu_social->add($eleveSecuSocial);
            $eleveSecuSocial->setCentreSecuriteSocial($this);
        }

        return $this;
    }

    public function removeEleveSecuSocial(Eleve $eleveSecuSocial): static
    {
        if ($this->eleve_secu_social->removeElement($eleveSecuSocial)) {
            // set the owning side to null (unless already changed)
            if ($eleveSecuSocial->getCentreSecuriteSocial() === $this) {
                $eleveSecuSocial->setCentreSecuriteSocial(null);
            }
        }

        return $this;
    }
}
