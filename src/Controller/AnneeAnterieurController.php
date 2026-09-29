<?php

namespace App\Controller;

use App\Entity\AnneeAnterieur;
use App\Form\AnneeAnterieurType;
use App\Repository\AnneeAnterieurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/annee/anterieur')]
final class AnneeAnterieurController extends AbstractController
{
    #[Route(name: 'app_annee_anterieur_index', methods: ['GET'])]
    public function index(AnneeAnterieurRepository $anneeAnterieurRepository): Response
    {
        return $this->render('annee_anterieur/index.html.twig', [
            'annee_anterieurs' => $anneeAnterieurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_annee_anterieur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $anneeAnterieur = new AnneeAnterieur();
        $form = $this->createForm(AnneeAnterieurType::class, $anneeAnterieur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($anneeAnterieur);
            $entityManager->flush();

            return $this->redirectToRoute('app_annee_anterieur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('annee_anterieur/new.html.twig', [
            'annee_anterieur' => $anneeAnterieur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_annee_anterieur_show', methods: ['GET'])]
    public function show(AnneeAnterieur $anneeAnterieur): Response
    {
        return $this->render('annee_anterieur/show.html.twig', [
            'annee_anterieur' => $anneeAnterieur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_annee_anterieur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AnneeAnterieur $anneeAnterieur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AnneeAnterieurType::class, $anneeAnterieur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_annee_anterieur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('annee_anterieur/edit.html.twig', [
            'annee_anterieur' => $anneeAnterieur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_annee_anterieur_delete', methods: ['POST'])]
    public function delete(Request $request, AnneeAnterieur $anneeAnterieur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$anneeAnterieur->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($anneeAnterieur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_annee_anterieur_index', [], Response::HTTP_SEE_OTHER);
    }
}
