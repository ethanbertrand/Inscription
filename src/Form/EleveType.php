<?php

namespace App\Form;

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

class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Num_securite_scoial')
            ->add('Nom')
            ->add('Prenom')
            ->add('date_naissance')
            ->add('Adresse')
            ->add('Num_Tel')
            ->add('Mail')
            ->add('Sexe')
            ->add('Num_Assurance_scolaire')
            ->add('Tel_Urgence')
            ->add('Date_Vaccin')
            ->add('Remarque_sante')
            ->add('Num_tel_domicile')
            ->add('accepte_sms')
            ->add('Photo')
            ->add('regime', EntityType::class, [
                'class' => Regime::class,
                'choice_label' => 'regime',
                'placeholder' => 'Sélectionnez un régime',
            ])
            ->add('assuranceScolaire', EntityType::class, [
                'class' => AssuranceScolaire::class,
                'choice_label' => 'id',
                'placeholder' => 'Sélectionnez une assurance scolaire',
            ])
            ->add('centreSecuriteSocial', EntityType::class, [
                'class' => CentreSecuriteSocial::class,
                'choice_label' => 'id',
                'placeholder' => 'Sélectionnez un centre de sécurité sociale',
            ])
            ->add('medecin', EntityType::class, [
                'class' => Medecin::class,
                'choice_label' => 'id',
                'placeholder' => 'Sélectionnez un médecin',
            ])
            ->add('mDL', EntityType::class, [
                'class' => MDL::class,
                'choice_label' => 'id',
                'placeholder' => 'Sélectionnez si vous voulez adhérer à la MDL',
            ])
            ->add('classe', EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'id',
                'placeholder' => 'Sélectionnez une classe',
            ])
            
            
            ->add('langueEleve', EntityType::class, [
                'class' => LangueEleve::class,
                'choice_label' => 'id',
                'placeholder' => 'Sélectionnez une langue',
            ])
            ->add('parentsEleve', EntityType::class, [
                'class' => ParentsEleve::class,
                'choice_label' => 'id',
                'placeholder' => 'Sélectionnez un parent',
            ])
            ->add('commune', EntityType::class, [
                'class' => Commune::class,
                'choice_label' => 'id',
                'placeholder' => 'Sélectionnez une commune',
            ])
            ->add('aTransport', EntityType::class, [
                'class' => ATransport::class,
                'choice_label' => 'id',
                'placeholder' => 'Sélectionnez un mode de transport',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Eleve::class,
        ]);
    }
}
