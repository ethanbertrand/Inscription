<?php

namespace App\Controller;

use App\Entity\LangueEleve;
use App\Form\LangueEleveType;
use App\Repository\LangueEleveRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/langue_elve')]
final class LangueEleveController extends AbstractController
{
    #[Route(name: 'app_langue_eleve_index', methods: ['GET'])]
    public function index(LangueEleveRepository $langueEleveRepository): Response
    {
        return $this->render('langue_eleve/index.html.twig', [
            'langue_eleves' => $langueEleveRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_langue_eleve_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $langueEleve = new LangueEleve();
        $form = $this->createForm(LangueEleveType::class, $langueEleve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($langueEleve);
            $entityManager->flush();

            return $this->redirectToRoute('app_langue_eleve_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('langue_eleve/new.html.twig', [
            'langue_eleve' => $langueEleve,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_langue_eleve_show', methods: ['GET'])]
    public function show(LangueEleve $langueEleve): Response
    {
        return $this->render('langue_eleve/show.html.twig', [
            'langue_eleve' => $langueEleve,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_langue_eleve_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, LangueEleve $langueEleve, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LangueEleveType::class, $langueEleve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_langue_eleve_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('langue_eleve/edit.html.twig', [
            'langue_eleve' => $langueEleve,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_langue_eleve_delete', methods: ['POST'])]
    public function delete(Request $request, LangueEleve $langueEleve, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$langueEleve->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($langueEleve);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_langue_eleve_index', [], Response::HTTP_SEE_OTHER);
    }
}
