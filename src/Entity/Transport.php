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

    #[ORM\ManyToOne(inversedBy: 'id_transport')]
    private ?ATransport $aTransport = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Immatriculation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Ligne = null;

    #[ORM\ManyToOne(inversedBy: 'type_transport')]
    private ?Type $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getImmatriculation(): ?string
    {
        return $this->Immatriculation;
    }

    public function setImmatriculation(?string $Immatriculation): static
    {
        $this->Immatriculation = $Immatriculation;

        return $this;
    }

    public function getLigne(): ?string
    {
        return $this->Ligne;
    }

    public function setLigne(?string $Ligne): static
    {
        $this->Ligne = $Ligne;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): static
    {
        $this->type = $type;

        return $this;
    }

    
}
