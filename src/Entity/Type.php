<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
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
    #[ORM\OneToMany(targetEntity: Transport::class, mappedBy: 'type')]
    private Collection $type_transport;

    public function __construct()
    {
        $this->type_transport = new ArrayCollection();
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
    public function getTypeTransport(): Collection
    {
        return $this->type_transport;
    }

    public function addTypeTransport(Transport $typeTransport): static
    {
        if (!$this->type_transport->contains($typeTransport)) {
            $this->type_transport->add($typeTransport);
            $typeTransport->setType($this);
        }

        return $this;
    }

    public function removeTypeTransport(Transport $typeTransport): static
    {
        if ($this->type_transport->removeElement($typeTransport)) {
            // set the owning side to null (unless already changed)
            if ($typeTransport->getType() === $this) {
                $typeTransport->setType(null);
            }
        }

        return $this;
    }
}
