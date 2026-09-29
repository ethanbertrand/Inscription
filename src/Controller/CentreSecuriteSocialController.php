<?php

namespace App\Controller;

use App\Entity\CentreSecuriteSocial;
use App\Form\CentreSecuriteSocialType;
use App\Repository\CentreSecuriteSocialRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/centre/securite/social')]
final class CentreSecuriteSocialController extends AbstractController
{
    #[Route(name: 'app_centre_securite_social_index', methods: ['GET'])]
    public function index(CentreSecuriteSocialRepository $centreSecuriteSocialRepository): Response
    {
        return $this->render('centre_securite_social/index.html.twig', [
            'centre_securite_socials' => $centreSecuriteSocialRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_centre_securite_social_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $centreSecuriteSocial = new CentreSecuriteSocial();
        $form = $this->createForm(CentreSecuriteSocialType::class, $centreSecuriteSocial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($centreSecuriteSocial);
            $entityManager->flush();

            return $this->redirectToRoute('app_centre_securite_social_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('centre_securite_social/new.html.twig', [
            'centre_securite_social' => $centreSecuriteSocial,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_centre_securite_social_show', methods: ['GET'])]
    public function show(CentreSecuriteSocial $centreSecuriteSocial): Response
    {
        return $this->render('centre_securite_social/show.html.twig', [
            'centre_securite_social' => $centreSecuriteSocial,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_centre_securite_social_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CentreSecuriteSocial $centreSecuriteSocial, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CentreSecuriteSocialType::class, $centreSecuriteSocial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_centre_securite_social_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('centre_securite_social/edit.html.twig', [
            'centre_securite_social' => $centreSecuriteSocial,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_centre_securite_social_delete', methods: ['POST'])]
    public function delete(Request $request, CentreSecuriteSocial $centreSecuriteSocial, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$centreSecuriteSocial->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($centreSecuriteSocial);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_centre_securite_social_index', [], Response::HTTP_SEE_OTHER);
    }
}
