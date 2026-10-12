<?php

namespace App\Controller;

use App\Entity\SecuriteSocial;
use App\Form\SecuriteSocialType;
use App\Repository\SecuriteSocialRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/securite/social')]
final class SecuriteSocialController extends AbstractController
{
    #[Route(name: 'app_securite_social_index', methods: ['GET'])]
    public function index(SecuriteSocialRepository $securiteSocialRepository): Response
    {
        return $this->render('securite_social/index.html.twig', [
            'securite_socials' => $securiteSocialRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_securite_social_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $securiteSocial = new SecuriteSocial();
        $form = $this->createForm(SecuriteSocialType::class, $securiteSocial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($securiteSocial);
            $entityManager->flush();

            return $this->redirectToRoute('app_securite_social_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('securite_social/new.html.twig', [
            'securite_social' => $securiteSocial,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_securite_social_show', methods: ['GET'])]
    public function show(SecuriteSocial $securiteSocial): Response
    {
        return $this->render('securite_social/show.html.twig', [
            'securite_social' => $securiteSocial,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_securite_social_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SecuriteSocial $securiteSocial, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SecuriteSocialType::class, $securiteSocial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_securite_social_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('securite_social/edit.html.twig', [
            'securite_social' => $securiteSocial,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_securite_social_delete', methods: ['POST'])]
    public function delete(Request $request, SecuriteSocial $securiteSocial, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$securiteSocial->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($securiteSocial);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_securite_social_index', [], Response::HTTP_SEE_OTHER);
    }
}
