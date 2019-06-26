<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CitoyenRepository")
 */
class Citoyen
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numeroElecteur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreVotes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombrePropositions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Demandes", mappedBy="createur")
     */
    private $demandesCreated;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Demandes", mappedBy="voteurs")
     */
    private $aVote;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vote", mappedBy="citoyen")
     */
    private $votes;

    public function __construct()
    {
        $this->demandesCreated = new ArrayCollection();
        $this->aVote = new ArrayCollection();
        $this->aVotePour = new ArrayCollection();
        $this->aVoteContre = new ArrayCollection();
        $this->aVoteAbstention = new ArrayCollection();
        $this->votes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNumeroElecteur(): ?int
    {
        return $this->numeroElecteur;
    }

    public function setNumeroElecteur(?int $numeroElecteur): self
    {
        $this->numeroElecteur = $numeroElecteur;

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

    public function getNombrePropositions(): ?int
    {
        return $this->nombrePropositions;
    }

    public function setNombrePropositions(?int $nombrePropositions): self
    {
        $this->nombrePropositions = $nombrePropositions;

        return $this;
    }

    /**
     * @return Collection|Demandes[]
     */
    public function getDemandesCreated(): Collection
    {
        return $this->demandesCreated;
    }

    public function addDemandesCreated(Demandes $demandesCreated): self
    {
        if (!$this->demandesCreated->contains($demandesCreated)) {
            $this->demandesCreated[] = $demandesCreated;
            $demandesCreated->setCreateur($this);
        }

        return $this;
    }

    public function removeDemandesCreated(Demandes $demandesCreated): self
    {
        if ($this->demandesCreated->contains($demandesCreated)) {
            $this->demandesCreated->removeElement($demandesCreated);
            // set the owning side to null (unless already changed)
            if ($demandesCreated->getCreateur() === $this) {
                $demandesCreated->setCreateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Demandes[]
     */
    public function getAVote(): Collection
    {
        return $this->aVote;
    }

    public function addAVote(Demandes $aVote): self
    {
        if (!$this->aVote->contains($aVote)) {
            $this->aVote[] = $aVote;
            $aVote->addVoteur($this);
        }

        return $this;
    }

    public function removeAVote(Demandes $aVote): self
    {
        if ($this->aVote->contains($aVote)) {
            $this->aVote->removeElement($aVote);
            $aVote->removeVoteur($this);
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
            $vote->setCitoyen($this);
        }

        return $this;
    }

    public function removeVote(Vote $vote): self
    {
        if ($this->votes->contains($vote)) {
            $this->votes->removeElement($vote);
            // set the owning side to null (unless already changed)
            if ($vote->getCitoyen() === $this) {
                $vote->setCitoyen(null);
            }
        }

        return $this;
    }


}
