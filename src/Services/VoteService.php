<?php


namespace App\Services;


use App\Entity\Citoyen;
use App\Entity\Demandes;
use App\Entity\Vote;
use App\Repository\DemandesRepository;
use App\Repository\VoteRepository;
use Doctrine\ORM\EntityManagerInterface;

class VoteService
{

	protected $voteRepository;
	protected $demandesRepository;
	protected $entityManager;

	public function __construct(VoteRepository $voteRepository, DemandesRepository $demandesRepository,
								EntityManagerInterface $entityManager)
	{
		$this->demandesRepository = $demandesRepository;
		$this->voteRepository = $voteRepository;
		$this->entityManager = $entityManager;
	}

	public function newVote(Citoyen $citoyen,Vote $voteExprime,Demandes $demande)
	{

		$voteExprime->setCitoyen($citoyen);
		$voteExprime->setDemande($demande);
		$this->entityManager->persist($voteExprime);

		$this->entityManager->flush();


		$demandeNombreVote =$demande->getNombreVotes();
		$demande->addVote($voteExprime);
		$demande->setNombreVotes($demandeNombreVote+1);
		$demande->addVoteur($citoyen);
		$this->entityManager->persist($demande);



		$userNombreVote = $citoyen->getNombreVotes();
		//Increment nombreVotes from the User
		$citoyen->addVote($voteExprime);
		$citoyen->setNombreVotes($userNombreVote+1);

		$this->entityManager->persist($citoyen);
		$this->entityManager->flush();

	}

	public function countVote(){
		$demandes = $this->demandesRepository->findAll();

		$votesCount = [];
		foreach($demandes as $key => $demande) {

			$votesCount[$key]['pour'] = count($this->voteRepository->getVotePour($demande->getId()));
			$votesCount[$key]['contre'] = count($this->voteRepository->getVoteContre($demande->getId()));
			$votesCount[$key]['abstention'] = count($this->voteRepository->getVoteAbstention($demande->getId()
			));
		}

		return $votesCount;
	}

}