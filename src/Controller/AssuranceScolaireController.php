<?php

namespace App\Controller;

use App\Entity\AssuranceScolaire;
use App\Form\AssuranceScolaireType;
use App\Repository\AssuranceScolaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/assurance/scolaire')]
final class AssuranceScolaireController extends AbstractController
{
    #[Route(name: 'app_assurance_scolaire_index', methods: ['GET'])]
    public function index(AssuranceScolaireRepository $assuranceScolaireRepository): Response
    {
        return $this->render('assurance_scolaire/index.html.twig', [
            'assurance_scolaires' => $assuranceScolaireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_assurance_scolaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $assuranceScolaire = new AssuranceScolaire();
        $form = $this->createForm(AssuranceScolaireType::class, $assuranceScolaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($assuranceScolaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_assurance_scolaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('assurance_scolaire/new.html.twig', [
            'assurance_scolaire' => $assuranceScolaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_assurance_scolaire_show', methods: ['GET'])]
    public function show(AssuranceScolaire $assuranceScolaire): Response
    {
        return $this->render('assurance_scolaire/show.html.twig', [
            'assurance_scolaire' => $assuranceScolaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_assurance_scolaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AssuranceScolaire $assuranceScolaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AssuranceScolaireType::class, $assuranceScolaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_assurance_scolaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('assurance_scolaire/edit.html.twig', [
            'assurance_scolaire' => $assuranceScolaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_assurance_scolaire_delete', methods: ['POST'])]
    public function delete(Request $request, AssuranceScolaire $assuranceScolaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$assuranceScolaire->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($assuranceScolaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_assurance_scolaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
