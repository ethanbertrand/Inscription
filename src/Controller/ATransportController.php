<?php

namespace App\Controller;

use App\Entity\ATransport;
use App\Form\ATransportType;
use App\Repository\ATransportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/a/transport')]
final class ATransportController extends AbstractController
{
    #[Route(name: 'app_a_transport_index', methods: ['GET'])]
    public function index(ATransportRepository $aTransportRepository): Response
    {
        return $this->render('a_transport/index.html.twig', [
            'a_transports' => $aTransportRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_a_transport_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $aTransport = new ATransport();
        $form = $this->createForm(ATransportType::class, $aTransport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($aTransport);
            $entityManager->flush();

            return $this->redirectToRoute('app_a_transport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('a_transport/new.html.twig', [
            'a_transport' => $aTransport,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_a_transport_show', methods: ['GET'])]
    public function show(ATransport $aTransport): Response
    {
        return $this->render('a_transport/show.html.twig', [
            'a_transport' => $aTransport,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_a_transport_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ATransport $aTransport, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ATransportType::class, $aTransport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_a_transport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('a_transport/edit.html.twig', [
            'a_transport' => $aTransport,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_a_transport_delete', methods: ['POST'])]
    public function delete(Request $request, ATransport $aTransport, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aTransport->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($aTransport);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_a_transport_index', [], Response::HTTP_SEE_OTHER);
    }
}
