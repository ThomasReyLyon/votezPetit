<?php

namespace App\Entity;

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
}
