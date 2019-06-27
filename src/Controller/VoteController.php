<?php


namespace App\Controller;


use App\Services\VoteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
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
	 * @Route("/", name="vote_index")
	 */
	public function vote(VoteService $voteService, Request $request):Response
	{
		$citoyenVotant = $this->getUser();

		$voteService->newVote($citoyenVotant);



		return $this->render("vote/vote.html.twig", [
			'vote' => ''
		]);
	}
}