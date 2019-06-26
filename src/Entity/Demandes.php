<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DemandesRepository")
 */
class Demandes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sommaire;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $budget;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categories", inversedBy="demandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $deadline;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isOuverte;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isValide;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Citoyen", inversedBy="demandesCreated")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreVotes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Citoyen", inversedBy="aVote")
     */
    private $voteurs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vote", mappedBy="demande")
     */
    private $votes;


    public function __construct()
    {
        $this->voteurs = new ArrayCollection();
        $this->votePour = new ArrayCollection();
        $this->voteContre = new ArrayCollection();
        $this->voteAbstention = new ArrayCollection();
        $this->votes = new ArrayCollection();
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

    public function getSommaire(): ?string
    {
        return $this->sommaire;
    }

    public function setSommaire(string $sommaire): self
    {
        $this->sommaire = $sommaire;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    public function setBudget(?int $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDeadline(): ?\DateTimeInterface
    {
        return $this->deadline;
    }

    public function setDeadline(\DateTimeInterface $deadline): self
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function getIsOuverte(): ?bool
    {
        return $this->isOuverte;
    }

    public function setIsOuverte(bool $isOuverte): self
    {
        $this->isOuverte = $isOuverte;

        return $this;
    }

    public function getIsValide(): ?bool
    {
        return $this->isValide;
    }

    public function setIsValide(bool $isValide): self
    {
        $this->isValide = $isValide;

        return $this;
    }

    public function getCreateur(): ?Citoyen
    {
        return $this->createur;
    }

    public function setCreateur(?Citoyen $createur): self
    {
        $this->createur = $createur;

        return $this;
    }

    public function getNombreVotes(): ?int
    {
        return $this->nombreVotes;
    }

    public function setNombreVotes(?int $nombreVotes): self
    {
        $this->nombreVotes = $nombreVotes;

        return $this;
    }

    /**
     * @return Collection|Citoyen[]
     */
    public function getVoteurs(): Collection
    {
        return $this->voteurs;
    }

    public function addVoteur(Citoyen $voteur): self
    {
        if (!$this->voteurs->contains($voteur)) {
            $this->voteurs[] = $voteur;
        }

        return $this;
    }

    public function removeVoteur(Citoyen $voteur): self
    {
        if ($this->voteurs->contains($voteur)) {
            $this->voteurs->removeElement($voteur);
        }

        return $this;
    }

    /**
     * @return Collection|Vote[]
     */
    public function getVotes(): Collection
    {
        return $this->votes;
    }

    public function addVote(Vote $vote): self
    {
        if (!$this->votes->contains($vote)) {
            $this->votes[] = $vote;
            $vote->setDemande($this);
        }

        return $this;
    }

    public function removeVote(Vote $vote): self
    {
        if ($this->votes->contains($vote)) {
            $this->votes->removeElement($vote);
            // set the owning side to null (unless already changed)
            if ($vote->getDemande() === $this) {
                $vote->setDemande(null);
            }
        }

        return $this;
    }

}
