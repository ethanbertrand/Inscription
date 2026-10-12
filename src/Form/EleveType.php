<?php

namespace App\Form;

use App\Entity\AnneeAnterieur;
use App\Entity\AssuranceScolaire;
use App\Entity\Atransport;
use App\Entity\Classe;
use App\Entity\Commune;
use App\Entity\Eleve;
use App\Entity\Langue;
use App\Entity\LesParent;
use App\Entity\MDL;
use App\Entity\Medecin;
use App\Entity\Regime;
use App\Entity\SecuriteSocial;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('num_securite_social')
            ->add('Nom')
            ->add('Prenom')
            ->add('date_naissance')
            ->add('Adresse')
            ->add('Num_tel')
            ->add('mail')
            ->add('Sexe')
            ->add('Num_assurance_scolaire')
            ->add('Tel_urgence')
            ->add('date_vaccin')
            ->add('Remarque_sante')
            ->add('Num_tel_domicile')
            ->add('accepte_sms')
            ->add('photo')
            ->add('classe_eleve', EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'id',
            ])
            ->add('medecin_eleve', EntityType::class, [
                'class' => Medecin::class,
                'choice_label' => 'id',
            ])
            ->add('mdl_eleve', EntityType::class, [
                'class' => MDL::class,
                'choice_label' => 'id',
            ])
            ->add('parent_eleve', EntityType::class, [
                'class' => LesParent::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('Commune_eleve', EntityType::class, [
                'class' => Commune::class,
                'choice_label' => 'id',
            ])
            ->add('annee_anterieur_eleve', EntityType::class, [
                'class' => AnneeAnterieur::class,
                'choice_label' => 'id',
            ])
            ->add('langueeleve', EntityType::class, [
                'class' => Langue::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('secu_eleve', EntityType::class, [
                'class' => SecuriteSocial::class,
                'choice_label' => 'id',
            ])
            ->add('AssuranceScolaire', EntityType::class, [
                'class' => AssuranceScolaire::class,
                'choice_label' => 'id',
            ])
            ->add('regime_eleve', EntityType::class, [
                'class' => Regime::class,
                'choice_label' => 'id',
            ])
            ->add('transport_eleve', EntityType::class, [
                'class' => Atransport::class,
                'choice_label' => 'id',
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
