<?php

namespace App\Controller;

use App\Entity\Citoyen;
use App\Form\CitoyenType;
use App\Form\RegisterType;
use App\Repository\CitoyenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/citoyen")
 */
class CitoyenController extends AbstractController
{
    /**
     * @Route("/", name="citoyen_index", methods={"GET"})
     */
    public function index(CitoyenRepository $citoyenRepository): Response
    {
        return $this->render('citoyen/index.html.twig', [
            'citoyens' => $citoyenRepository->findAll(),
        ]);
    }

    /**
     * @Route("/registration", name="citoyen_registration", methods={"GET","POST"})
     */
    public function new(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder): Response
    {
        $citoyen = new Citoyen();
        $form = $this->createForm(CitoyenType::class, $citoyen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($citoyen, $citoyen->getPassword());
            $citoyen->setPassword($hash);

            $manager->persist($citoyen);
            $manager->flush();
            $this->addFlash('success', 'yess');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('citoyen/new.html.twig', [
            'citoyen' => $citoyen,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="citoyen_show", methods={"GET"})
     */
    public function show(Citoyen $citoyen): Response
    {
        return $this->render('citoyen/show.html.twig', [
            'citoyen' => $citoyen,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="citoyen_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Citoyen $citoyen): Response
    {
        $form = $this->createForm(CitoyenType::class, $citoyen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('citoyen_index', [
                'id' => $citoyen->getId(),
            ]);
        }

        return $this->render('citoyen/edit.html.twig', [
            'citoyen' => $citoyen,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="citoyen_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Citoyen $citoyen): Response
    {
        if ($this->isCsrfTokenValid('delete'.$citoyen->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($citoyen);
            $entityManager->flush();
        }

        return $this->redirectToRoute('citoyen_index');
    }
}
