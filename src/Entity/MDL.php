<?php

namespace App\Entity;

use App\Repository\MDLRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: MDLRepository::class)]
class MDL
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Cheque = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Photo = null;

    #[ORM\Column]
    private ?bool $Adhesion = null;

    /**
     * @var Collection<int, Eleve>
     */
    #[ORM\OneToMany(targetEntity: Eleve::class, mappedBy: 'mdl_eleve')]
    private Collection $eleves;

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCheque(): ?string
    {
        return $this->Cheque;
    }

    public function setCheque(?string $Cheque): static
    {
        $this->Cheque = $Cheque;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->Photo;
    }

    public function setPhoto(?string $Photo): static
    {
        $this->Photo = $Photo;

        return $this;
    }

    public function isAdhesion(): ?bool
    {
        return $this->Adhesion;
    }

    public function setAdhesion(bool $Adhesion): static
    {
        $this->Adhesion = $Adhesion;

        return $this;
    }

    /**
     * @return Collection<int, Eleve>
     */
    public function getEleves(): Collection
    {
        return $this->eleves;
    }

    public function addElefe(Eleve $elefe): static
    {
        if (!$this->eleves->contains($elefe)) {
            $this->eleves->add($elefe);
            $elefe->setMdlEleve($this);
        }

        return $this;
    }

    public function removeElefe(Eleve $elefe): static
    {
        if ($this->eleves->removeElement($elefe)) {
            // set the owning side to null (unless already changed)
            if ($elefe->getMdlEleve() === $this) {
                $elefe->setMdlEleve(null);
            }
        }

        return $this;
    }
    #[Assert\Callback(groups: ['scolarite'])]
public function validateAdhesion(ExecutionContextInterface $context): void
{
    if ($this->Adhesion && !$this->Cheque) {
        $context->buildViolation('Le chèque est obligatoire pour adhérer à la MDL.')
            ->atPath('Cheque')
            ->addViolation();
    }
}
#[Assert\Image(
    maxSize: '5M',
    mimeTypes: ['image/jpeg', 'image/png', 'image/webp'],
    mimeTypesMessage: 'Seuls les formats JPEG, PNG et WebP sont acceptés.',
    maxSizeMessage: 'La photo ne doit pas dépasser 5 Mo.',
    groups: ['scolarite'],
)]
private ?UploadedFile $photoFile = null;

public function getPhotoFile(): ?UploadedFile
{
    return $this->photoFile;
}

public function setPhotoFile(?UploadedFile $photoFile): static
{
    $this->photoFile = $photoFile;

    return $this;
}
}
