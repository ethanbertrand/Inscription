<?php

namespace App\Form\Eleve;

use App\Entity\ATransport;
use App\Entity\AssuranceScolaire;
use App\Entity\CentreSecuriteSocial;
use App\Entity\Classe;
use App\Entity\Commune;
use App\Entity\Eleve;
use App\Entity\Langue;
use App\Entity\LangueEleve;
use App\Entity\MDL;
use App\Entity\Medecin;
use App\Entity\Nationalite;
use App\Entity\NationaliteEleve;
use App\Entity\ParentsEleve;
use App\Entity\Regime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Event\SubmitEvent;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvents;
class ScolariteType extends AbstractType
{
    public function __construct(private EntityManagerInterface $em)
    {
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('classe_eleve', EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'Libelle',
                'placeholder' => 'Sélectionnez une classe',
            ])
            ->add('regime_eleve', EntityType::class, [
                'class' => Regime::class,
                'choice_label' => 'Regime',
                'placeholder' => 'Sélectionnez un régime',
            ])
           ->add('transports', CollectionType::class, [
                'entry_type' => TransportType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => 'Transports',
                'attr' => ['class' => 'js-transports'],
            ])
            ->add('mdl_eleve', MdlAdhesionType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('langueEleves', CollectionType::class, [
                    'entry_type' => LangueEleveType::class,
                    'entry_options' => ['label' => false],
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label' => 'Langues',
                    'attr' => ['class' => 'js-langues'],
            ])
            ->add('AssuranceScolaire', EntityType::class, [
                'class' => AssuranceScolaire::class,
                'choice_label' => 'Nom',
                'placeholder' => 'Sélectionnez une assurance scolaire',
                'required' => false,
                'row_attr' => ['class' => 'js-row-assurance-select'],
            ])
            ->add('ajouterAssurance', CheckboxType::class, [
                'label' => "Mon assurance n'est pas dans la liste",
                'mapped' => false,
                'required' => false,
            ])
            ->add('nouvelleAssuranceNom', TextType::class, [
                'label' => "Nom de l'assurance",
                'mapped' => false,
                'required' => false,
                'row_attr' => ['class' => 'js-row-assurance-new'],
            ])
            ->add('nouvelleAssuranceAdresse', TextType::class, [
                'label' => "Adresse de l'assurance",
                'mapped' => false,
                'required' => false,
                'row_attr' => ['class' => 'js-row-assurance-new'],
            ])
            ->add('Num_assurance_scolaire');

            $builder->addEventListener(FormEvents::SUBMIT, function (SubmitEvent $event) {
                $form = $event->getForm();
                if (!$form->get('ajouterAssurance')->getData()) {
                    return;
                }

                $eleve = $form->getData();
                if (!$eleve instanceof Eleve) {
                    return;
                }

                $nom = trim((string) $form->get('nouvelleAssuranceNom')->getData());
                $adresse = trim((string) $form->get('nouvelleAssuranceAdresse')->getData());

                if ($nom === '') {
                    $form->get('nouvelleAssuranceNom')->addError(new FormError("Indiquez le nom de l'assurance."));

                    return;
                }
                if (mb_strlen($nom) > 50 || mb_strlen($adresse) > 50) {
                    $form->get('nouvelleAssuranceNom')->addError(new FormError('Le nom et l\'adresse sont limités à 50 caractères.'));

                    return;
                }

                // évite les doublons : on réutilise l'assurance si elle existe déjà
                $assurance = $this->em->getRepository(AssuranceScolaire::class)
                    ->findOneBy(['Nom' => $nom, 'Adresse' => $adresse])
                    ?? (new AssuranceScolaire())->setNom($nom)->setAdresse($adresse);

                $eleve->setAssuranceScolaire($assurance);
            });
    }


}
