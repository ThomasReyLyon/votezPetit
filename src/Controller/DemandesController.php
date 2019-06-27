<?php

namespace App\Controller;

use App\Entity\Citoyen;
use App\Entity\Demandes;
use App\Form\DemandesType;
use App\Repository\DemandesRepository;
use DateInterval;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Faker\Test\Provider\DateTimeTest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Tests\Extension\Core\Type\DateIntervalTypeTest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/demandes")
 */
class DemandesController extends AbstractController
{
    /**
     * @Route("/", name="demandes_index", methods={"GET"})
     */
    public function index(DemandesRepository $demandesRepository): Response
    {
        return $this->render('demandes/index.html.twig', [
            'demandes' => $demandesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="demandes_new", methods={"GET","POST"})
     */
    public function new(Request $request, Citoyen $citoyen): Response
    {
        $demande = new Demandes();
        $form = $this->createForm(DemandesType::class, $demande);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $demande->setCreatedAt(new DateTime());
            $now = new DateTime();
            $demande->setDeadline($now->add(new DateInterval('P30D')));
            $demande->setIsOuverte(true);
            $demande->setIsValide(true);
            $createur=$this->getUser()->getId();
            dump($createur);
            $demande->setCreateur($citoyen);

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($demande);
            $entityManager->flush();

         //   return $this->redirectToRoute('demandes_index');
        }

        return $this->render('demandes/new.html.twig', [
            'demande' => $demande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="demandes_show", methods={"GET"})
     */
    public function show(Demandes $demande): Response
    {
        return $this->render('demandes/show.html.twig', [
            'demande' => $demande,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="demandes_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Demandes $demande): Response
    {
        $form = $this->createForm(DemandesType::class, $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('demandes_index', [
                'id' => $demande->getId(),
            ]);
        }

        return $this->render('demandes/edit.html.twig', [
            'demande' => $demande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="demandes_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Demandes $demande): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demande->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($demande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('demandes_index');
    }
}
