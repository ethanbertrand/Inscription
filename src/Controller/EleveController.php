<?php

namespace App\Controller;

use Symfony\Component\Form\Flow\DataStorage\SessionDataStorage;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\Eleve;
use App\Form\EleveType;
use App\Repository\EleveRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\Eleve\EleveFlowType;
use Symfony\Component\Form\Flow\DataStorage\NullDataStorage;

#[Route('/eleve')]
final class EleveController extends AbstractController
{
    #[Route(name: 'app_eleve_index', methods: ['GET'])]
    public function index(EleveRepository $eleveRepository): Response
    {
        return $this->render('eleve/index.html.twig', [
            'eleves' => $eleveRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_eleve_new', methods: ['GET'])]
    public function new(EntityManagerInterface $em): Response
    {
        $eleve = new Eleve();
        $em->persist($eleve);
        $em->flush();

        return $this->redirectToRoute('app_eleve_edit', ['id' => $eleve->getId()]);
    }

    #[Route('/{id}', name: 'app_eleve_show', methods: ['GET'])]
    public function show(Eleve $eleve): Response
    {
        return $this->render('eleve/show.html.twig', [
            'eleve' => $eleve,
        ]);
    }

#[Route('/{id}/edit', name: 'app_eleve_edit', methods: ['GET', 'POST'])]
public function edit(Request $request, Eleve $eleve, EntityManagerInterface $em): Response
{
    return $this->handleFlow($request, $em, $eleve);
}


    #[Route('/{id}', name: 'app_eleve_delete', methods: ['POST'])]
    public function delete(Request $request, Eleve $eleve, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eleve->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($eleve);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_eleve_index', [], Response::HTTP_SEE_OTHER);
    }
    private function handleFlow(Request $request, EntityManagerInterface $em, Eleve $eleve): Response
{
    $flow = $this->createForm(EleveFlowType::class, $eleve, [
        'data_storage' => new NullDataStorage(),
    ]);
    $flow->handleRequest($request);

    // Dernière étape terminée : on publie et on quitte
    if ($flow->isSubmitted() && $flow->isValid() && $flow->isFinished()) {
        $eleve->setStatus('published');
        $em->flush();

        return $this->redirectToRoute('app_eleve_show', ['id' => $eleve->getId()], Response::HTTP_SEE_OTHER);
    }

    $status = match (true) {
        !$flow->isSubmitted() => Response::HTTP_OK,
        !$flow->isValid()     => Response::HTTP_UNPROCESSABLE_ENTITY,
        default               => Response::HTTP_SEE_OTHER,
    };

    // Un seul appel : il fait avancer currentStep sur l'entité
    $stepForm = $flow->getStepForm();

    // Étape validée mais pas terminée : on enregistre données ET nouvelle étape
    if ($flow->isSubmitted() && $flow->isValid()) {
        $em->flush();
    }

    return $this->render('eleve/flow.html.twig', [
        'form' => $stepForm,
        'eleve' => $eleve,
    ], new Response(status: $status));
}
}
