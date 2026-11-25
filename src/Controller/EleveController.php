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
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity\AssuranceScolaire;
use Symfony\Component\Form\FormError;
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
    $scolariteEnvoyee = $this->applyAssurance($request, $em, $eleve);

$flow->handleRequest($request);

if ($scolariteEnvoyee && $flow->isSubmitted() && !$eleve->getAssuranceScolaire()) {
    $flow->addError(new FormError('Choisissez une assurance ou ajoutez-en une (nom obligatoire, 50 caractères maximum).'));
}
    if ($flow->isSubmitted() && !$flow->isValid()) {
    foreach ($flow->getErrors(true) as $error) {
        dump(
            $error->getOrigin()->getName(),                     // nom du champ concerné
            $error->getCause()?->getPropertyPath(),             // propriété de Eleve concernée
            $error->getMessage(),
        );
    }
}

    if ($flow->isSubmitted() && $flow->isValid()) {
        $this->savePhoto($eleve);
    }

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
private function savePhoto(Eleve $eleve): void
{
    $file = $eleve->getPhotoFile();
    if (!$file) {
        return;   // aucune nouvelle photo : on garde l'ancienne
    }

    $dir = $this->getParameter('kernel.project_dir').'/public/uploads/photos';
    $name = bin2hex(random_bytes(8)).'.'.$file->guessExtension();

    $file->move($dir, $name);
    $eleve->setPhoto($name);
    $eleve->setPhotoFile(null);
}
/**
 * Applique le choix d'assurance de l'étape "scolarite".
 * Retourne true si cette étape vient d'être envoyée.
 */
private function applyAssurance(Request $request, EntityManagerInterface $em, Eleve $eleve): bool
{
    if (!$request->isMethod('POST')) {
        return false;
    }

    $data = $request->request->all('eleve_flow')['scolarite'] ?? null;
    if (!is_array($data)) {
        return false;
    }

    if (!empty($data['ajouterAssurance'])) {
        $nom = trim((string) ($data['nouvelleAssuranceNom'] ?? ''));
        $adresse = trim((string) ($data['nouvelleAssuranceAdresse'] ?? ''));

        // vide ou trop long (limite VARCHAR(50)) : rien n'est enregistré, l'erreur sera affichée
        if ($nom === '' || mb_strlen($nom) > 50 || mb_strlen($adresse) > 50) {
            $eleve->setAssuranceScolaire(null);

            return true;
        }

        $assurance = $em->getRepository(AssuranceScolaire::class)
            ->findOneBy(['Nom' => $nom, 'Adresse' => $adresse]);

        if (!$assurance) {
            $assurance = (new AssuranceScolaire())->setNom($nom)->setAdresse($adresse);
            $em->persist($assurance);
        }

        $eleve->setAssuranceScolaire($assurance);
    } elseif (!empty($data['AssuranceScolaire'])) {
        $eleve->setAssuranceScolaire(
            $em->getRepository(AssuranceScolaire::class)->find((int) $data['AssuranceScolaire'])
        );
    } else {
        $eleve->setAssuranceScolaire(null);
    }

    return true;
}
}
