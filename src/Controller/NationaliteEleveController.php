<?php

namespace App\Controller;

use App\Entity\NationaliteEleve;
use App\Form\NationaliteEleveType;
use App\Repository\NationaliteEleveRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/nationaliteeleve')]
final class NationaliteEleveController extends AbstractController
{
    #[Route(name: 'app_nationalite_eleve_index', methods: ['GET'])]
    public function index(NationaliteEleveRepository $nationaliteEleveRepository): Response
    {
        return $this->render('nationalite_eleve/index.html.twig', [
            'nationalite_eleves' => $nationaliteEleveRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_nationalite_eleve_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $nationaliteEleve = new NationaliteEleve();
        $form = $this->createForm(NationaliteEleveType::class, $nationaliteEleve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($nationaliteEleve);
            $entityManager->flush();

            return $this->redirectToRoute('app_nationalite_eleve_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('nationalite_eleve/new.html.twig', [
            'nationalite_eleve' => $nationaliteEleve,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nationalite_eleve_show', methods: ['GET'])]
    public function show(NationaliteEleve $nationaliteEleve): Response
    {
        return $this->render('nationalite_eleve/show.html.twig', [
            'nationalite_eleve' => $nationaliteEleve,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_nationalite_eleve_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, NationaliteEleve $nationaliteEleve, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NationaliteEleveType::class, $nationaliteEleve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_nationalite_eleve_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('nationalite_eleve/edit.html.twig', [
            'nationalite_eleve' => $nationaliteEleve,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nationalite_eleve_delete', methods: ['POST'])]
    public function delete(Request $request, NationaliteEleve $nationaliteEleve, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nationaliteEleve->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($nationaliteEleve);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_nationalite_eleve_index', [], Response::HTTP_SEE_OTHER);
    }
}
