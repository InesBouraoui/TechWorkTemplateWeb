<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfilRepository;

#[ORM\Entity(repositoryClass: ProfilRepository::class)]
class Profil
{
    
    #[ORM\Id]
    #[ORM\Column(name:"id_Profil")]
    #[ORM\GeneratedValue]
    private ?int $id;

    #[ORM\Column(name:"Nom")]
    private ?string $Nom;

    #[ORM\Column(name:"Prenom")]
    private ?string $Prenom;

    #[ORM\Column(name:"NumeroTelephone")]
    private  ?string $NumeroTelephone;

    #[ORM\Column(name:"Email")]
    private ?string $Email;

    #[ORM\Column]
    private ?string $Localisation;

    #[ORM\Column]
    private ?string $Description;

    #[ORM\Column]
    private ?string $Langues;

    #[ORM\Column]
    private ?string $Competences;

    #[ORM\Column]
    private ?string $Formation;

    #[ORM\Column]
    private ?string $ExperiencesProfessionnelles;

    #[ORM\Column]
    private ?string $latitude;

    #[ORM\Column]
    private ?string $longitude;

    #[ORM\Column]
    private ?string $Diplome;

    public function getIdProfil(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $nom): self
    {
        $this->Nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->Prenom = $prenom;

        return $this;
    }

    public function getNuméroTéléphone(): ?string
    {
        return $this->NumeroTelephone;
    }

    public function setNuméroTéléphone(string $numéroTéléphone): self
    {
        $this->NumeroTelephone = $numéroTéléphone;

        return $this;
    }

    public function getEMail(): ?string
    {
        return $this->Email;
    }

    public function setEMail(string $eMail): self
    {
        $this->Email = $eMail;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->Localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->Localisation = $localisation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $description): self
    {
        $this->Description = $description;

        return $this;
    }

    public function getLangues(): ?string
    {
        return $this->Langues;
    }

    public function setLangues(string $langues): self
    {
        $this->Langues = $langues;

        return $this;
    }

    public function getCompetences(): ?string
    {
        return $this->Competences;
    }

    public function setCompetences(string $competences): self
    {
        $this->Competences = $competences;

        return $this;
    }

    public function getFormation(): ?string
    {
        return $this->Formation;
    }

    public function setFormation(string $formation): self
    {
        $this->Formation = $formation;

        return $this;
    }

    public function getExperiencesProfessionnelles(): ?string
    {
        return $this->ExperiencesProfessionnelles;
    }

    public function setExperiencesProfessionnelles(string $experiencesProfessionnelles): self
    {
        $this->ExperiencesProfessionnelles = $experiencesProfessionnelles;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getDiplome(): ?string
    {
        return $this->Diplome;
    }

    public function setDiplome(string $diplome): self
    {
        $this->Diplome = $diplome;

        return $this;
    }


}
