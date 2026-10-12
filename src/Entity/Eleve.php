<?php 
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\EleveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EleveRepository::class)]
class Eleve
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(groups: ['identite'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $num_securite_social = null;

    #[Assert\NotBlank(groups: ['identite'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Nom = null;

    #[Assert\NotBlank(groups: ['identite'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Prenom = null;

    #[Assert\NotNull(groups: ['identite'])]
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $date_naissance = null;

    #[Assert\NotBlank(groups: ['coordonnees'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Adresse = null;

    #[Assert\NotBlank(groups: ['coordonnees'])]
    #[ORM\Column(nullable: true)]
    private ?int $Num_tel = null;

    #[Assert\NotBlank(groups: ['coordonnees'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mail = null;

    #[Assert\NotBlank(groups: ['identite'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Sexe = null;

    #[Assert\NotBlank(groups: ['scolarite'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Num_assurance_scolaire = null;

    #[Assert\NotBlank(groups: ['coordonnees'])]
    #[ORM\Column(nullable: true)]
    private ?int $Tel_urgence = null;

    #[Assert\NotNull(groups: ['sante'])]
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $date_vaccin = null;

    #[Assert\NotBlank(groups: ['sante'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Remarque_sante = null;

    #[Assert\NotBlank(groups: ['coordonnees'])]
    #[ORM\Column(nullable: true)]
    private ?int $Num_tel_domicile = null;

    #[Assert\NotBlank(groups: ['coordonnees'])]
    #[ORM\Column(nullable: true)]
    private ?bool $accepte_sms = null;

    #[Assert\NotBlank(groups: ['identite'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[Assert\NotNull(groups: ['scolarite'])]
    #[ORM\ManyToOne(inversedBy: 'eleves')]
    private ?Classe $classe_eleve = null;

    #[Assert\NotNull(groups: ['sante'])]
    #[ORM\ManyToOne(inversedBy: 'eleves')]
    private ?Medecin $medecin_eleve = null;

    #[Assert\NotNull(groups: ['scolarite'])]
    #[ORM\ManyToOne(inversedBy: 'eleves')]
    private ?MDL $mdl_eleve = null;

    /**
     * @var Collection<int, LesParent>
     */
    #[ORM\ManyToMany(targetEntity: LesParent::class, inversedBy: 'eleves')]
    private Collection $parent_eleve;

    #[Assert\NotNull(groups: ['coordonnees'])]
    #[ORM\ManyToOne(inversedBy: 'eleves')]
    private ?Commune $Commune_eleve = null;

    #[ORM\ManyToOne(inversedBy: 'eleves')]
    private ?AnneeAnterieur $annee_anterieur_eleve = null;

    /**
     * @var Collection<int, Langue>
     */
    #[Assert\NotNull(groups: ['scolarite'])]
    #[ORM\ManyToMany(targetEntity: Langue::class, inversedBy: 'eleves')]
    private Collection $langueeleve;

    #[Assert\NotNull(groups: ['sante'])]
    #[ORM\ManyToOne(inversedBy: 'eleves')]
    private ?SecuriteSocial $secu_eleve = null;

    #[ORM\Column(length: 20)]
    private string $status = 'draft';

    #[ORM\Column(length: 50)]
    private string $currentStep = 'identite';
    #[Assert\NotNull(groups: ['scolarite'])]
    #[ORM\ManyToOne(inversedBy: 'eleves')]
    private ?AssuranceScolaire $AssuranceScolaire = null;

    #[Assert\NotNull(groups: ['scolarite'])]
    #[ORM\ManyToOne(inversedBy: 'eleves')]
    private ?Regime $regime_eleve = null;

    #[Assert\NotNull(groups: ['scolarite'])]
    #[ORM\ManyToOne(inversedBy: 'eleves')]
    private ?ATransport $transport_eleve = null;

    public function __construct()
    {
        $this->parent_eleve = new ArrayCollection();
        $this->langueeleve = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumSecuriteSocial(): ?string
    {
        return $this->num_securite_social;
    }

    public function setNumSecuriteSocial(?string $num_securite_social): static
    {
        $this->num_securite_social = $num_securite_social;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(?string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(?string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTime
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(?\DateTime $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(?string $Adresse): static
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getNumTel(): ?int
    {
        return $this->Num_tel;
    }

    public function setNumTel(?int $Num_tel): static
    {
        $this->Num_tel = $Num_tel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->Sexe;
    }

    public function setSexe(?string $Sexe): static
    {
        $this->Sexe = $Sexe;

        return $this;
    }

    public function getNumAssuranceScolaire(): ?string
    {
        return $this->Num_assurance_scolaire;
    }

    public function setNumAssuranceScolaire(?string $Num_assurance_scolaire): static
    {
        $this->Num_assurance_scolaire = $Num_assurance_scolaire;

        return $this;
    }

    public function getTelUrgence(): ?int
    {
        return $this->Tel_urgence;
    }

    public function setTelUrgence(?int $Tel_urgence): static
    {
        $this->Tel_urgence = $Tel_urgence;

        return $this;
    }

    public function getDateVaccin(): ?\DateTime
    {
        return $this->date_vaccin;
    }

    public function setDateVaccin(?\DateTime $date_vaccin): static
    {
        $this->date_vaccin = $date_vaccin;

        return $this;
    }

    public function getRemarqueSante(): ?string
    {
        return $this->Remarque_sante;
    }

    public function setRemarqueSante(?string $Remarque_sante): static
    {
        $this->Remarque_sante = $Remarque_sante;

        return $this;
    }

    public function getNumTelDomicile(): ?int
    {
        return $this->Num_tel_domicile;
    }

    public function setNumTelDomicile(?int $Num_tel_domicile): static
    {
        $this->Num_tel_domicile = $Num_tel_domicile;

        return $this;
    }

    public function isAccepteSms(): ?bool
    {
        return $this->accepte_sms;
    }

    public function setAccepteSms(?bool $accepte_sms): static
    {
        $this->accepte_sms = $accepte_sms;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getClasseEleve(): ?Classe
    {
        return $this->classe_eleve;
    }

    public function setClasseEleve(?Classe $classe_eleve): static
    {
        $this->classe_eleve = $classe_eleve;

        return $this;
    }

    public function getMedecinEleve(): ?Medecin
    {
        return $this->medecin_eleve;
    }

    public function setMedecinEleve(?Medecin $medecin_eleve): static
    {
        $this->medecin_eleve = $medecin_eleve;

        return $this;
    }

    public function getMdlEleve(): ?MDL
    {
        return $this->mdl_eleve;
    }

    public function setMdlEleve(?MDL $mdl_eleve): static
    {
        $this->mdl_eleve = $mdl_eleve;

        return $this;
    }

    /**
     * @return Collection<int, LesParent>
     */
    public function getParentEleve(): Collection
    {
        return $this->parent_eleve;
    }

    public function addParentEleve(LesParent $parentEleve): static
    {
        if (!$this->parent_eleve->contains($parentEleve)) {
            $this->parent_eleve->add($parentEleve);
        }

        return $this;
    }

    public function removeParentEleve(LesParent $parentEleve): static
    {
        $this->parent_eleve->removeElement($parentEleve);

        return $this;
    }

    public function getCommuneEleve(): ?Commune
    {
        return $this->Commune_eleve;
    }

    public function setCommuneEleve(?Commune $Commune_eleve): static
    {
        $this->Commune_eleve = $Commune_eleve;

        return $this;
    }

    public function getAnneeAnterieurEleve(): ?AnneeAnterieur
    {
        return $this->annee_anterieur_eleve;
    }

    public function setAnneeAnterieurEleve(?AnneeAnterieur $annee_anterieur_eleve): static
    {
        $this->annee_anterieur_eleve = $annee_anterieur_eleve;

        return $this;
    }

    /**
     * @return Collection<int, Langue>
     */
    public function getLangueeleve(): Collection
    {
        return $this->langueeleve;
    }

    public function addLangueeleve(Langue $langueeleve): static
    {
        if (!$this->langueeleve->contains($langueeleve)) {
            $this->langueeleve->add($langueeleve);
        }

        return $this;
    }

    public function removeLangueeleve(Langue $langueeleve): static
    {
        $this->langueeleve->removeElement($langueeleve);

        return $this;
    }

    public function getSecuEleve(): ?SecuriteSocial
    {
        return $this->secu_eleve;
    }

    public function setSecuEleve(?SecuriteSocial $secu_eleve): static
    {
        $this->secu_eleve = $secu_eleve;

        return $this;
    }

    public function getAssuranceScolaire(): ?AssuranceScolaire
    {
        return $this->AssuranceScolaire;
    }

    public function setAssuranceScolaire(?AssuranceScolaire $AssuranceScolaire): static
    {
        $this->AssuranceScolaire = $AssuranceScolaire;

        return $this;
    }

    public function getRegimeEleve(): ?Regime
    {
        return $this->regime_eleve;
    }

    public function setRegimeEleve(?Regime $regime_eleve): static
    {
        $this->regime_eleve = $regime_eleve;

        return $this;
    }

    public function getTransportEleve(): ?ATransport
    {
        return $this->transport_eleve;
    }

    public function setTransportEleve(?ATransport $transport_eleve): static
    {
        $this->transport_eleve = $transport_eleve;

        return $this;
    }

    public function getStatus(): string
{
    return $this->status;
}

public function setStatus(string $status): static
{
    $this->status = $status;

    return $this;
}

public function getCurrentStep(): string
{
    return $this->currentStep;
}

public function setCurrentStep(string $currentStep): static
{
    $this->currentStep = $currentStep;

    return $this;
}
}
