<?php

namespace App\Entity;

use App\Repository\ATransportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ATransportRepository::class)]
class ATransport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Eleve>
     */
    #[ORM\OneToMany(targetEntity: Eleve::class, mappedBy: 'aTransport')]
    private Collection $id_eleve;

    /**
     * @var Collection<int, Transport>
     */
    #[ORM\OneToMany(targetEntity: Transport::class, mappedBy: 'aTransport')]
    private Collection $id_transport;

    public function __construct()
    {
        $this->id_eleve = new ArrayCollection();
        $this->id_transport = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Eleve>
     */
    public function getIdEleve(): Collection
    {
        return $this->id_eleve;
    }

    public function addIdEleve(Eleve $idEleve): static
    {
        if (!$this->id_eleve->contains($idEleve)) {
            $this->id_eleve->add($idEleve);
            $idEleve->setATransport($this);
        }

        return $this;
    }

    public function removeIdEleve(Eleve $idEleve): static
    {
        if ($this->id_eleve->removeElement($idEleve)) {
            // set the owning side to null (unless already changed)
            if ($idEleve->getATransport() === $this) {
                $idEleve->setATransport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Transport>
     */
    public function getIdTransport(): Collection
    {
        return $this->id_transport;
    }

    public function addIdTransport(Transport $idTransport): static
    {
        if (!$this->id_transport->contains($idTransport)) {
            $this->id_transport->add($idTransport);
            $idTransport->setATransport($this);
        }

        return $this;
    }

    public function removeIdTransport(Transport $idTransport): static
    {
        if ($this->id_transport->removeElement($idTransport)) {
            // set the owning side to null (unless already changed)
            if ($idTransport->getATransport() === $this) {
                $idTransport->setATransport(null);
            }
        }

        return $this;
    }
}
