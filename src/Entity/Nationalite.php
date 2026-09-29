<?php

namespace App\Entity;

use App\Repository\NationaliteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NationaliteRepository::class)]
class Nationalite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Pays = null;

    #[ORM\ManyToOne(inversedBy: 'id_nationalite')]
    private ?NationaliteEleve $nationaliteEleve = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(string $Pays): static
    {
        $this->Pays = $Pays;

        return $this;
    }

    public function getNationaliteEleve(): ?NationaliteEleve
    {
        return $this->nationaliteEleve;
    }

    public function setNationaliteEleve(?NationaliteEleve $nationaliteEleve): static
    {
        $this->nationaliteEleve = $nationaliteEleve;

        return $this;
    }
}
