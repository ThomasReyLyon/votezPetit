<?php


namespace App\Services;


use App\Entity\Citoyen;
use App\Entity\Demandes;
use App\Entity\Vote;
use App\Repository\DemandesRepository;
use App\Repository\VoteRepository;

class VoteService
{

	protected $voteRepository;
	protected $demandesRepository;

	public function __construct(VoteRepository $voteRepository, DemandesRepository $demandesRepository)
	{
		$this->demandesRepository = $demandesRepository;
		$this->voteRepository = $voteRepository;

	}

	public function newVote(Citoyen $citoyen, $voteExprime)
	{
		$vote = new Vote();
		$demande = new Demandes();
		$demandeNombreVote =$demande->getNombreVotes();
		$userNombreVote = $citoyen->getNombreVotes();

		$vote->setEtat($voteExprime);

		$demande->addVote($vote);
		$demande->setNombreVotes($demandeNombreVote+1);

		//Increment nombreVotes from the User
		$citoyen->addVote($vote);

		$citoyen->setNombreVotes($userNombreVote+1);

		return $citoyen;

	}

}