<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CandidatureRepository;

#[ORM\Entity(repositoryClass: CandidatureRepository::class)]
class Candidature
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private ?int $id;

    #[ORM\ManyToOne(inversedBy: 'candidatures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Offre $offre = null;
 
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $candidat = null;

    #[ORM\Column]
    private ?string $status;

    #[ORM\Column]
    private ?string $details;

    #[ORM\Column]
    private ?datetime $datepostulation;

    #[ORM\Column]
    private ?datetime $datemodification;




    public function getId(): ?int
    {
        return $this->id;
    }



    public function getRecruteur(): ?string
    {
        return $this->recruteur;
    }

    public function setRecruteur(string $recruteur): self
    {
        $this->recruteur = $recruteur;

        return $this;
    }

 

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getDatepostulation(): ?datetime
    {
        return $this->datepostulation;
    }

    public function setDatepostulation(datetime $datepostulation): self
    {
        $this->datepostulation = $datepostulation;

        return $this;
    }

    public function getDatemodification(): ?datetime
    {
        return $this->datemodification;
    }

    public function setDatemodification(datetime $datemodification): self
    {
        $this->datemodification = $datemodification;

        return $this;
    }

    public function getOffre(): ?Offre
    {
        return $this->offre;
    }

    public function setOffre(?Offre $offre): self
    {
        $this->offre = $offre;

        return $this;
    }

    public function getCandidat(): ?Utilisateur
    {
        return $this->candidat;
    }

    public function setCandidat(?Utilisateur $candidat): self
    {
        $this->candidat = $candidat;

        return $this;
    }


}
