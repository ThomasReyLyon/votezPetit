<?php


namespace App\Controller;


use App\Entity\Citoyen;
use App\Entity\Demandes;
use App\Entity\Vote;
use App\Form\VoteType;
use App\Repository\DemandesRepository;
use App\Repository\VoteRepository;
use App\Service\Pagination;
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
	 * @Route("/{page}", name="vote_index", methods={"GET", "POST"}, defaults={"page" :"1"})
	 */
	public function voteIndex(DemandesRepository $demandesRepository, VoteService $voteService,Pagination
	$pagination, Request $request, $page)
	{


		return $this->render('home/index.html.twig', [
			'pagination' => $pagination->pagination($page), /*  Twig{% for lien in pagination.countDemandes %}<a
			 href="{{ path("vote_index", {'page' : lien}) }}">{{ lien }}</a>{% endfor %} pour afficher lien vers page
 . Et  {% for demande in demandes  | slice(pagination.pageFloorSlice, 5)%} pour gérer la vue */
			'demandes' => $demandesRepository->findAll(),
			'votes' => $voteService->countVote($demandesRepository->findAll())
		]);
	}
	/**
	 * @return Response
	 * @Route("/newvote/{id}", name="vote_avote", methods={"GET", "POST"}, requirements={"[0-9]+"})
	 */
	public function vote(VoteService $voteService, Request $request, Demandes $demande):Response
	{

		  $vote = new Vote();

		$citoyenVotant = $this->getUser();

		$vote->setEtat($request->query->get('vote'));
		dump($request->query->get('vote'));
		$voteService->newVote($citoyenVotant, $vote, $demande);

		return $this->redirectToRoute("vote_index");
	}
}