<?php

namespace App\Controller;

use App\Entity\MDL;
use App\Form\MDLType;
use App\Repository\MDLRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/mdl')]
final class MDLController extends AbstractController
{
    #[Route(name: 'app_m_d_l_index', methods: ['GET'])]
    public function index(MDLRepository $mDLRepository): Response
    {
        return $this->render('mdl/index.html.twig', [
            'm_d_ls' => $mDLRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_m_d_l_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $mDL = new MDL();
        $form = $this->createForm(MDLType::class, $mDL);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($mDL);
            $entityManager->flush();

            return $this->redirectToRoute('app_m_d_l_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mdl/new.html.twig', [
            'm_d_l' => $mDL,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_m_d_l_show', methods: ['GET'])]
    public function show(MDL $mDL): Response
    {
        return $this->render('mdl/show.html.twig', [
            'm_d_l' => $mDL,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_m_d_l_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MDL $mDL, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MDLType::class, $mDL);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_m_d_l_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mdl/edit.html.twig', [
            'm_d_l' => $mDL,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_m_d_l_delete', methods: ['POST'])]
    public function delete(Request $request, MDL $mDL, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mDL->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($mDL);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_m_d_l_index', [], Response::HTTP_SEE_OTHER);
    }
}
