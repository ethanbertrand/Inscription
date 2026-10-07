<?php

namespace App\Form\Eleve;

use App\Entity\ATransport;
use App\Entity\AssuranceScolaire;
use App\Entity\CentreSecuriteSocial;
use App\Entity\Classe;
use App\Entity\Commune;
use App\Entity\Eleve;
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
class ScolariteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Classe')
            ->add('Regime', EntityType::class, [
                'class' => Regime::class,
                'choice_label' => 'nom',
                'placeholder' => 'Sélectionnez un régime',
            ])
            ->add('aTransport', EntityType::class, [
                'class' => ATransport::class,
                'choice_label' => 'nom',
                'placeholder' => 'Sélectionnez un type de transport',
            ])
            ->add('mDL')
            ->add('langueEleve', EntityType::class, [
                'class' => LangueEleve::class,
                'choice_label' => 'nom',
                'placeholder' => 'Sélectionnez une langue',
            ])
            ->add('assuranceScolaire', EntityType::class, [
                'class' => AssuranceScolaire::class,
                'choice_label' => 'nom',
                'placeholder' => 'Sélectionnez une assurance scolaire',
            ])
            ->add('Num_Assurance_scolaire');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Eleve::class]);
    }
}
