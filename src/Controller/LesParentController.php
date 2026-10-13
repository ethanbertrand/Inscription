<?php

namespace App\Controller;

use App\Entity\LesParent;
use App\Form\LesParentType;
use App\Repository\LesParentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/parents')]
final class LesParentController extends AbstractController
{
    #[Route(name: 'app_les_parent_index', methods: ['GET'])]
    public function index(LesParentRepository $lesParentRepository): Response
    {
        return $this->render('les_parent/index.html.twig', [
            'les_parents' => $lesParentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_les_parent_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $lesParent = new LesParent();
        $form = $this->createForm(LesParentType::class, $lesParent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($lesParent);
            $entityManager->flush();

            return $this->redirectToRoute('app_les_parent_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('les_parent/new.html.twig', [
            'les_parent' => $lesParent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_les_parent_show', methods: ['GET'])]
    public function show(LesParent $lesParent): Response
    {
        return $this->render('les_parent/show.html.twig', [
            'les_parent' => $lesParent,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_les_parent_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, LesParent $lesParent, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LesParentType::class, $lesParent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_les_parent_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('les_parent/edit.html.twig', [
            'les_parent' => $lesParent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_les_parent_delete', methods: ['POST'])]
    public function delete(Request $request, LesParent $lesParent, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lesParent->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($lesParent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_les_parent_index', [], Response::HTTP_SEE_OTHER);
    }
}
