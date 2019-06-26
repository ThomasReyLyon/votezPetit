<?php


namespace App\Controller;


use App\Repository\ProblemsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MapController extends AbstractController
{
    /**
     * @Route("/map", name="map")
     */
    public function map2(
        ProblemsRepository $problemsRepository
    ) {
        return $this->render('map/map.html.twig', [
            'problems' => $problemsRepository->findAll(),

        ]);
    }
}