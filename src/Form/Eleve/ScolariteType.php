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
class ScolariteType extends AbstractType
{
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
            ->add('langueeleve', EntityType::class, [
                'class' => Langue::class,
                'choice_label' => 'Libelle',
                'placeholder' => 'Sélectionnez une langue',
                'multiple' => true,
            ])
            ->add('AssuranceScolaire', EntityType::class, [
                'class' => AssuranceScolaire::class,
                'choice_label' => 'Nom',
                'placeholder' => 'Sélectionnez une assurance scolaire',
            ])
            ->add('Num_assurance_scolaire');
    }


}
