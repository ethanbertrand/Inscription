<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\UniqueConstraint(columns: ['eleve_id', 'langue_id'])]
class LangueEleve
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'langueEleves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Eleve $eleve = null;

    #[Assert\NotNull(message: 'Choisissez une langue.', groups: ['scolarite'])]
    #[ORM\ManyToOne]
    private ?Langue $langue = null;

    #[Assert\NotNull(message: 'Choisissez LV1 ou LV2.', groups: ['scolarite'])]
    #[Assert\Choice(choices: [1, 2], groups: ['scolarite'])]
    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $lv = 1;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEleve(): ?Eleve
    {
        return $this->eleve;
    }

    public function setEleve(?Eleve $eleve): static
    {
        $this->eleve = $eleve;

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

    public function getLv(): ?int
    {
        return $this->lv;
    }

    public function setLv(?int $lv): static
    {
        $this->lv = $lv;

        return $this;
    }
}