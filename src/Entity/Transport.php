<?php

namespace App\Entity;

use App\Repository\TransportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransportRepository::class)]
class Transport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Ligne = null;

    #[ORM\Column(length: 255)]
    private ?string $Immatriculation = null;

    #[ORM\ManyToOne(inversedBy: 'transporttype')]
    private ?TypeTransport $typeTransport = null;

    #[ORM\ManyToOne(inversedBy: 'transports')]
    private ?Atransport $auntransport = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLigne(): ?string
    {
        return $this->Ligne;
    }

    public function setLigne(string $Ligne): static
    {
        $this->Ligne = $Ligne;

        return $this;
    }

    public function getImmatriculation(): ?string
    {
        return $this->Immatriculation;
    }

    public function setImmatriculation(string $Immatriculation): static
    {
        $this->Immatriculation = $Immatriculation;

        return $this;
    }

    public function getTypeTransport(): ?TypeTransport
    {
        return $this->typeTransport;
    }

    public function setTypeTransport(?TypeTransport $typeTransport): static
    {
        $this->typeTransport = $typeTransport;

        return $this;
    }

    public function getAuntransport(): ?Atransport
    {
        return $this->auntransport;
    }

    public function setAuntransport(?Atransport $auntransport): static
    {
        $this->auntransport = $auntransport;

        return $this;
    }
}
