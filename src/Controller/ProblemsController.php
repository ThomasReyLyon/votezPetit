<?php

namespace App\Controller;

use App\Entity\Problems;
use App\Form\Problems1Type;
use App\Repository\ProblemsRepository;
use App\Service\GeoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/problems")
 */
class ProblemsController extends AbstractController
{
    /**
     * @Route("/", name="problems_index", methods={"GET"})
     * @param ProblemsRepository $problemsRepository
     * @return Response
     */
    public function index(ProblemsRepository $problemsRepository): Response
    {
        return $this->render('problems/index.html.twig', [
            'problems' => $problemsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="problems_new", methods={"GET","POST"})
     * @param Request $request
     * @param GeoService $geoService
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function new(Request $request, GeoService $geoService): Response
    {
        $problem = new Problems();
        $form = $this->createForm(Problems1Type::class, $problem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $geoService->geocode($problem);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($problem);
            $entityManager->flush();

            return $this->redirectToRoute('problems_index');
        }

        return $this->render('problems/new.html.twig', [
            'problem' => $problem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="problems_show", methods={"GET"})
     * @param Problems $problem
     * @return Response
     */
    public function show(Problems $problem): Response
    {
        return $this->render('problems/show.html.twig', [
            'problem' => $problem,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="problems_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Problems $problem
     * @return Response
     */
    public function edit(Request $request, Problems $problem): Response
    {
        $form = $this->createForm(Problems1Type::class, $problem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('problems_index', [
                'id' => $problem->getId(),
            ]);
        }

        return $this->render('problems/edit.html.twig', [
            'problem' => $problem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="problems_delete", methods={"DELETE"})
     * @param Request $request
     * @param Problems $problem
     * @return Response
     */
    public function delete(Request $request, Problems $problem): Response
    {
        if ($this->isCsrfTokenValid('delete'.$problem->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($problem);
            $entityManager->flush();
        }

        return $this->redirectToRoute('problems_index');
    }
}
