<?php


namespace App\Controller;


use App\Entity\Citoyen;
use App\Entity\Vote;
use App\Services\VoteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * Class VoteController
 * @package App\Controller
 * @Route("/vote")
 */
class VoteController extends AbstractController
{
	/**
	 * @return Response
	 * @Route("/", name="vote_index"), methods={"GET", "POST"})
	 */
	public function vote(VoteService $voteService, Request $request, Vote $vote):Response
	{
		$citoyenVotant = new Citoyen();

		$citoyenVotant->setNom('XXX')
			->setEmail('toto@toto.fr')
			->setRoles('ROLE_USER')
			->setPrenom('JACK')
			->setPassword('XXXX')
			->a

		//$citoyenVotant = $this->getUser();

		$voteExprime = $request->request->get('vote');

		$voteService->newVote($citoyenVotant, $voteExprime);



		$this->redirectToRoute('home');

	}
}