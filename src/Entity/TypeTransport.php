<?php

namespace App\Entity;

use App\Repository\TypeTransportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeTransportRepository::class)]
class TypeTransport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Libelle = null;

    /**
     * @var Collection<int, Transport>
     */
    #[ORM\OneToMany(targetEntity: Transport::class, mappedBy: 'typeTransport')]
    private Collection $transporttype;

    public function __construct()
    {
        $this->transporttype = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Transport>
     */
    public function getTransporttype(): Collection
    {
        return $this->transporttype;
    }

    public function addTransporttype(Transport $transporttype): static
    {
        if (!$this->transporttype->contains($transporttype)) {
            $this->transporttype->add($transporttype);
            $transporttype->setTypeTransport($this);
        }

        return $this;
    }

    public function removeTransporttype(Transport $transporttype): static
    {
        if ($this->transporttype->removeElement($transporttype)) {
            // set the owning side to null (unless already changed)
            if ($transporttype->getTypeTransport() === $this) {
                $transporttype->setTypeTransport(null);
            }
        }

        return $this;
    }
}
