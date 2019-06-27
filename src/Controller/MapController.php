<?php


namespace App\Controller;


use App\Entity\Problems;
use App\Form\Problems1Type;
use App\Repository\ProblemsRepository;
use App\Service\GeoService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MapController extends AbstractController
{
    /**
     * @Route("/map", name="map")
     */
    public function newProblem(Request $request, GeoService $geoService, ProblemsRepository $problemsRepository): Response
    {
        $problem = new Problems();
        $form = $this->createForm(Problems1Type::class, $problem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $geoService->geocode($problem);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($problem);
            $entityManager->flush();

            return $this->redirectToRoute('map');
        }

        return $this->render('map/map.html.twig', [
            'problem' => $problem,
            'problems' => $problemsRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/validate", name="validate", methods={"GET","POST"})
     * @param Request $request
     * @param Problems $problem
     * @return Response
     */
    public function validate(Request $request, Problems $problem): Response
    {
        $problem->setValidations($problem->getValidations()+1);

        $this->getDoctrine()->getManager()->flush();

        if($problem->getValidations() > 3){
            dump($problem);

        }
        return $this->redirectToRoute('map', [
            'id' => $problem->getId(),
        ]);

    }



}