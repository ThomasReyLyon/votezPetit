<?php

namespace App\Controller;

use App\Entity\Vote;
use App\Form\VoteType;
use App\Repository\DemandesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(DemandesRepository $demandesRepository)
    {

		return $this->redirectToRoute("vote_index");
    }

    /**
     * @Route("/show", name="show")
     */
    public function show()
    {
        return $this->render('home/show.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
