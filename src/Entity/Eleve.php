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
    #[ORM\Column(nullable: true)]
    private ?int $Num_securite_scoial = null;

    #[Assert\NotBlank(groups: ['identite'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Nom = null;

    #[Assert\NotBlank(groups: ['identite'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Prenom = null;

    #[Assert\NotNull(groups: ['identite'])]
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $date_naissance = null;
    
    #[Assert\NotBlank(groups: ['coordonee'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Adresse = null;

    #[Assert\NotBlank(groups: ['coordonee'])]
    #[ORM\Column(nullable: true)]
    private ?int $Num_Tel = null;

    #[Assert\NotBlank(groups: ['coordonee'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Mail = null;

    #[Assert\NotBlank(groups: ['identite'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Sexe = null;

    #[Assert\NotBlank(groups: ['scolarite'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Num_Assurance_scolaire = null;

    #[Assert\NotBlank(groups: ['coordonee'])]
    #[ORM\Column(nullable: true)]
    private ?int $Tel_Urgence = null;

    #[Assert\NotNull(groups: ['sante'])]
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $Date_Vaccin = null;

    #[Assert\NotBlank(groups: ['sante'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Remarque_sante = null;

    #[Assert\NotBlank(groups: ['coordonee'])]
    #[ORM\Column(nullable: true)]
    private ?int $Num_tel_domicile = null;

    #[Assert\NotBlank(groups: ['coordonee'])]
    #[ORM\Column(nullable: true)]
    private ?bool $accepte_sms = null;

    #[Assert\NotBlank(groups: ['identite'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Photo = null;

    #[Assert\NotNull(groups: ['scolarite'])]
    #[ORM\ManyToOne(inversedBy: 'regime_eleve')]
    private ?Regime $regime = null;

    #[Assert\NotNull(groups: ['scolarite'])]
    #[ORM\ManyToOne(inversedBy: 'assurance_eleve')]
    private ?AssuranceScolaire $assuranceScolaire = null;

    #[Assert\NotNull(groups: ['sante'])]
    #[ORM\ManyToOne(inversedBy: 'eleve_secu_social')]
    private ?CentreSecuriteSocial $centreSecuriteSocial = null;

    #[Assert\NotNull(groups: ['sante'])]
    #[ORM\ManyToOne(inversedBy: 'medecin_eleve')]
    private ?Medecin $medecin = null;

    #[Assert\NotNull(groups: ['scolarite'])]
    #[ORM\ManyToOne(inversedBy: 'mdl_eleve')]
    private ?MDL $mDL = null;

    #[Assert\NotNull(groups: ['scolarite'])]
    #[ORM\ManyToOne(inversedBy: 'classe_eleve')]
    private ?Classe $classe = null;

    

    /**
     * @var Collection<int, Nationalite>
     */
    

    #[Assert\NotNull(groups: ['scolarite'])]
    #[ORM\ManyToOne(inversedBy: 'id_eleve')]
    private ?LangueEleve $langueEleve = null;

    /**
     * @var Collection<int, AnneeAnterieur>
     */
    #[ORM\OneToMany(targetEntity: AnneeAnterieur::class, mappedBy: 'annee_eleve')]
    private Collection $anneeAnterieurs;

    #[Assert\NotNull(groups: ['parent'])]
    #[ORM\ManyToOne(inversedBy: 'id_eleve')]
    private ?ParentsEleve $parentsEleve = null;

    #[Assert\NotNull(groups: ['coordonee'])]
    #[ORM\ManyToOne(inversedBy: 'Commune_eleve')]
    private ?Commune $commune = null;

    #[Assert\NotNull(groups: ['scolarite'])]
    #[ORM\ManyToOne(inversedBy: 'id_eleve')]
    private ?ATransport $aTransport = null;

    #[ORM\Column(length: 20)]
    private string $status = 'draft';

    #[ORM\Column(length: 50)]
    private string $currentStep = 'identite';

    /**
     * @var Collection<int, NationaliteEleve>
     */
    #[ORM\OneToMany(targetEntity: NationaliteEleve::class, mappedBy: 'eleve_nation')]
    private Collection $nationaliteEleves;

    public function __construct()
    {
        $this->nationalites = new ArrayCollection();
        $this->anneeAnterieurs = new ArrayCollection();
        $this->nationaliteEleves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumSecuriteScoial(): ?int
    {
        return $this->Num_securite_scoial;
    }

    public function setNumSecuriteScoial(?int $Num_securite_scoial): static
    {
        $this->Num_securite_scoial = $Num_securite_scoial;

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
        return $this->Num_Tel;
    }

    public function setNumTel(?int $Num_Tel): static
    {
        $this->Num_Tel = $Num_Tel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->Mail;
    }

    public function setMail(?string $Mail): static
    {
        $this->Mail = $Mail;

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
        return $this->Num_Assurance_scolaire;
    }

    public function setNumAssuranceScolaire(?string $Num_Assurance_scolaire): static
    {
        $this->Num_Assurance_scolaire = $Num_Assurance_scolaire;

        return $this;
    }

    public function getTelUrgence(): ?int
    {
        return $this->Tel_Urgence;
    }

    public function setTelUrgence(?int $Tel_Urgence): static
    {
        $this->Tel_Urgence = $Tel_Urgence;

        return $this;
    }

    public function getDateVaccin(): ?\DateTime
    {
        return $this->Date_Vaccin;
    }

    public function setDateVaccin(?\DateTime $Date_Vaccin): static
    {
        $this->Date_Vaccin = $Date_Vaccin;

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
        return $this->Photo;
    }

    public function setPhoto(?string $Photo): static
    {
        $this->Photo = $Photo;

        return $this;
    }

    public function getRegime(): ?Regime
    {
        return $this->regime;
    }

    public function setRegime(?Regime $regime): static
    {
        $this->regime = $regime;

        return $this;
    }

    public function getAssuranceScolaire(): ?AssuranceScolaire
    {
        return $this->assuranceScolaire;
    }

    public function setAssuranceScolaire(?AssuranceScolaire $assuranceScolaire): static
    {
        $this->assuranceScolaire = $assuranceScolaire;

        return $this;
    }

    public function getCentreSecuriteSocial(): ?CentreSecuriteSocial
    {
        return $this->centreSecuriteSocial;
    }

    public function setCentreSecuriteSocial(?CentreSecuriteSocial $centreSecuriteSocial): static
    {
        $this->centreSecuriteSocial = $centreSecuriteSocial;

        return $this;
    }

    public function getMedecin(): ?Medecin
    {
        return $this->medecin;
    }

    public function setMedecin(?Medecin $medecin): static
    {
        $this->medecin = $medecin;

        return $this;
    }

    public function getMDL(): ?MDL
    {
        return $this->mDL;
    }

    public function setMDL(?MDL $mDL): static
    {
        $this->mDL = $mDL;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): static
    {
        $this->classe = $classe;

        return $this;
    }

    

    

    public function getLangueEleve(): ?LangueEleve
    {
        return $this->langueEleve;
    }

    public function setLangueEleve(?LangueEleve $langueEleve): static
    {
        $this->langueEleve = $langueEleve;

        return $this;
    }

    /**
     * @return Collection<int, AnneeAnterieur>
     */
    public function getAnneeAnterieurs(): Collection
    {
        return $this->anneeAnterieurs;
    }

    public function addAnneeAnterieur(AnneeAnterieur $anneeAnterieur): static
    {
        if (!$this->anneeAnterieurs->contains($anneeAnterieur)) {
            $this->anneeAnterieurs->add($anneeAnterieur);
            $anneeAnterieur->setAnneeEleve($this);
        }

        return $this;
    }

    public function removeAnneeAnterieur(AnneeAnterieur $anneeAnterieur): static
    {
        if ($this->anneeAnterieurs->removeElement($anneeAnterieur)) {
            // set the owning side to null (unless already changed)
            if ($anneeAnterieur->getAnneeEleve() === $this) {
                $anneeAnterieur->setAnneeEleve(null);
            }
        }

        return $this;
    }

    public function getParentsEleve(): ?ParentsEleve
    {
        return $this->parentsEleve;
    }

    public function setParentsEleve(?ParentsEleve $parentsEleve): static
    {
        $this->parentsEleve = $parentsEleve;

        return $this;
    }

    public function getCommune(): ?Commune
    {
        return $this->commune;
    }

    public function setCommune(?Commune $commune): static
    {
        $this->commune = $commune;

        return $this;
    }

    public function getATransport(): ?ATransport
    {
        return $this->aTransport;
    }

    public function setATransport(?ATransport $aTransport): static
    {
        $this->aTransport = $aTransport;

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
            $nationaliteElefe->setEleveNation($this);
        }

        return $this;
    }

    public function removeNationaliteElefe(NationaliteEleve $nationaliteElefe): static
    {
        if ($this->nationaliteEleves->removeElement($nationaliteElefe)) {
            // set the owning side to null (unless already changed)
            if ($nationaliteElefe->getEleveNation() === $this) {
                $nationaliteElefe->setEleveNation(null);
            }
        }

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
