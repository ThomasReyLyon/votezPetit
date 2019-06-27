<?php


namespace App\Controller;


use App\Entity\Citoyen;
use App\Entity\Demandes;
use App\Entity\Vote;
use App\Form\VoteType;
use App\Repository\DemandesRepository;
use App\Repository\VoteRepository;
use App\Service\VoteService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
	 * @Route("/", name="vote_index", methods={"GET", "POST"})
	 */
	public function voteIndex(DemandesRepository $demandesRepository, VoteService $voteService)
	{


		return $this->render('home/index.html.twig', [
			'demandes' => $demandesRepository->findAll(),
			'votes' => $voteService->countVote()
		]);
	}
	/**
	 * @return Response
	 * @Route("/{id}", name="vote_avote", methods={"GET", "POST"}, requirements={"[0-9]+"})
	 */
	public function vote(VoteService $voteService,
						 Request $request,
						 EntityManagerInterface $entityManager,
						 Demandes $demande,
						 VoteRepository $voteRepository):Response
	{

		  $vote = new Vote();

		$citoyenVotant = $this->getUser();

		$vote->setEtat($request->query->get('vote'));

		$voteService->newVote($citoyenVotant, $vote, $demande);

		return $this->redirectToRoute("vote_index");
	}
}