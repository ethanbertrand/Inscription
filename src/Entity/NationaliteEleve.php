<?php

namespace App\Entity;

use App\Repository\NationaliteEleveRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NationaliteEleveRepository::class)]
class NationaliteEleve
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'nationaliteEleves')]
    private ?Nationalite $nationalite_pays = null;

    #[ORM\ManyToOne(inversedBy: 'nationaliteEleves')]
    private ?Eleve $eleve_nation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNationalitePays(): ?Nationalite
    {
        return $this->nationalite_pays;
    }

    public function setNationalitePays(?Nationalite $nationalite_pays): static
    {
        $this->nationalite_pays = $nationalite_pays;

        return $this;
    }

    public function getEleveNation(): ?Eleve
    {
        return $this->eleve_nation;
    }

    public function setEleveNation(?Eleve $eleve_nation): static
    {
        $this->eleve_nation = $eleve_nation;

        return $this;
    }
}
