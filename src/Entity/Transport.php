<?php

namespace App\Entity;

use App\Repository\TransportRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: TransportRepository::class)]
class Transport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Ligne = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Immatriculation = null;

    #[ORM\ManyToOne(inversedBy: 'transporttype')]
    private ?TypeTransport $typeTransport = null;



    public function getId(): ?int
    {
        return $this->id;
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

    public function getImmatriculation(): ?string
    {
        return $this->Immatriculation;
    }

    public function setImmatriculation(?string $Immatriculation): static
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

#[ORM\ManyToOne(inversedBy: 'transports')]
private ?Eleve $eleve = null;

public function getEleve(): ?Eleve
{
    return $this->eleve;
}

public function setEleve(?Eleve $eleve): static
{
    $this->eleve = $eleve;

    return $this;
}

    #[Assert\Callback(groups: ['scolarite'])]
public function validateTransport(ExecutionContextInterface $context): void
{
    if (!$this->typeTransport) {
        $context->buildViolation('Choisissez un type de transport.')
            ->atPath('typeTransport')->addViolation();

        return;
    }

    if ($this->typeTransport->isImmatriculationRequise() && !$this->Immatriculation) {
        $context->buildViolation("L'immatriculation est obligatoire pour ce transport.")
            ->atPath('Immatriculation')->addViolation();
    }
}
}
