<?php


namespace App\Services;


use App\Entity\Citoyen;
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

	public function newVote(Citoyen $user)
	{
		$vote = new Vote();
		//Increment nombreVotes from the User
		$UserNombreVote = $user->setNombreVotes($user->getNombreVotes()++);

		$user->addVote($vote);


		return $this->voteRepository->findAll();

	}

}