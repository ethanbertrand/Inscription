<?php

namespace App\Entity;

use App\Repository\NationaliteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, NationaliteEleve>
     */
    #[ORM\OneToMany(targetEntity: NationaliteEleve::class, mappedBy: 'nationalite_pays')]
    private Collection $nationaliteEleves;

    public function __construct()
    {
        $this->nationaliteEleves = new ArrayCollection();
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

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(string $Pays): static
    {
        $this->Pays = $Pays;

        return $this;
    }

    /**
     * @return Collection<int, NationaliteEleve>
     */
    public function getNationaliteEleves(): Collection
    {
        return $this->nationaliteEleves;
    }

    public function addNationaliteElefe(NationaliteEleve $nationaliteElefe): static
    {
        if (!$this->nationaliteEleves->contains($nationaliteElefe)) {
            $this->nationaliteEleves->add($nationaliteElefe);
            $nationaliteElefe->setNationalitePays($this);
        }

        return $this;
    }

    public function removeNationaliteElefe(NationaliteEleve $nationaliteElefe): static
    {
        if ($this->nationaliteEleves->removeElement($nationaliteElefe)) {
            // set the owning side to null (unless already changed)
            if ($nationaliteElefe->getNationalitePays() === $this) {
                $nationaliteElefe->setNationalitePays(null);
            }
        }

        return $this;
    }
}
