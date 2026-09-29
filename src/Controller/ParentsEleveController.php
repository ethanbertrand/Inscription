<?php

namespace App\Controller;

use App\Entity\ParentsEleve;
use App\Form\ParentsEleveType;
use App\Repository\ParentsEleveRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/parents/eleve')]
final class ParentsEleveController extends AbstractController
{
    #[Route(name: 'app_parents_eleve_index', methods: ['GET'])]
    public function index(ParentsEleveRepository $parentsEleveRepository): Response
    {
        return $this->render('parents_eleve/index.html.twig', [
            'parents_eleves' => $parentsEleveRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_parents_eleve_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $parentsEleve = new ParentsEleve();
        $form = $this->createForm(ParentsEleveType::class, $parentsEleve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($parentsEleve);
            $entityManager->flush();

            return $this->redirectToRoute('app_parents_eleve_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('parents_eleve/new.html.twig', [
            'parents_eleve' => $parentsEleve,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_parents_eleve_show', methods: ['GET'])]
    public function show(ParentsEleve $parentsEleve): Response
    {
        return $this->render('parents_eleve/show.html.twig', [
            'parents_eleve' => $parentsEleve,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_parents_eleve_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ParentsEleve $parentsEleve, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParentsEleveType::class, $parentsEleve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_parents_eleve_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('parents_eleve/edit.html.twig', [
            'parents_eleve' => $parentsEleve,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_parents_eleve_delete', methods: ['POST'])]
    public function delete(Request $request, ParentsEleve $parentsEleve, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parentsEleve->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($parentsEleve);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_parents_eleve_index', [], Response::HTTP_SEE_OTHER);
    }
}
