<?php

namespace App\Form;

use App\Entity\AnneeAnterieur;
use App\Entity\Etablissement;
use App\Entity\Langue;
use App\Entity\eleve;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnneeAnterieurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('annee')
            ->add('Classe')
            ->add('uneoption')
            ->add('langue1', EntityType::class, [
                'class' => Langue::class,
                'choice_label' => 'id',
            ])
            ->add('langue2', EntityType::class, [
                'class' => Langue::class,
                'choice_label' => 'id',
            ])
            ->add('annee_eleve', EntityType::class, [
                'class' => eleve::class,
                'choice_label' => 'id',
            ])
            ->add('etablissement', EntityType::class, [
                'class' => Etablissement::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AnneeAnterieur::class,
        ]);
    }
}
