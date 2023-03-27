<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\OffreRepository;

#[ORM\Entity(repositoryClass: OffreRepository::class)]
class Offre
{
    
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private ?int $id;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $recruteur = null;

    #[ORM\ManyToMany(targetEntity: Domaine::class, inversedBy: 'offres')]
    private Collection $domaine;

    #[ORM\ManyToOne]
    private ?Contrat $contrat = null;

    #[ORM\OneToMany(mappedBy: 'offre', targetEntity: Candidature::class)]
    private Collection $candidatures;

    #[ORM\Column]
    private ?string $titre;

    #[ORM\Column]
    private ?string $description;

    #[ORM\Column]
    private ?int $salaire;

    #[ORM\Column]
    private ?string $lieu;

    #[ORM\Column]
    private ?string $status;

    #[ORM\Column]
    private ?int $duree;

    #[ORM\Column]
    private ?string $post;




    public function __construct()
    {
        $this->domaine = new ArrayCollection();
        $this->candidatures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPost(): ?string
    {
        return $this->post;
    }

    public function setPost(string $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getSalaire(): ?int
    {
        return $this->salaire;
    }

    public function setSalaire(int $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

 

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

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



    public function getRecruteur(): ?Utilisateur
    {
        return $this->recruteur;
    }

    public function setRecruteur(?Utilisateur $recruteur): self
    {
        $this->recruteur = $recruteur;

        return $this;
    }

    /**
     * @return Collection<int, Domaine>
     */
    public function getDomaine(): Collection
    {
        return $this->domaine;
    }

    public function addDomaine(Domaine $domaine): self
    {
        if (!$this->domaine->contains($domaine)) {
            $this->domaine->add($domaine);
        }

        return $this;
    }

    public function removeDomaine(Domaine $domaine): self
    {
        $this->domaine->removeElement($domaine);

        return $this;
    }

    public function getContrat(): ?Contrat
    {
        return $this->contrat;
    }

    public function setContrat(?Contrat $contrat): self
    {
        $this->contrat = $contrat;

        return $this;
    }

    /**
     * @return Collection<int, Candidature>
     */
    public function getCandidatures(): Collection
    {
        return $this->candidatures;
    }

    public function addCandidature(Candidature $candidature): self
    {
        if (!$this->candidatures->contains($candidature)) {
            $this->candidatures->add($candidature);
            $candidature->setOffre($this);
        }

        return $this;
    }

    public function removeCandidature(Candidature $candidature): self
    {
        if ($this->candidatures->removeElement($candidature)) {
            // set the owning side to null (unless already changed)
            if ($candidature->getOffre() === $this) {
                $candidature->setOffre(null);
            }
        }

        return $this;
    }


}
