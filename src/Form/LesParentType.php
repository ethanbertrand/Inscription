<?php

namespace App\Form;

use App\Entity\Eleve;
use App\Entity\LesParent;
use App\Entity\Statut;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LesParentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('Prenom')
            ->add('Adresse')
            ->add('Tel_portable')
            ->add('Tel_fixe')
            ->add('Tel_entreprise')
            ->add('Poste')
            ->add('Statut_parent', EntityType::class, [
                'class' => Statut::class,
                'choice_label' => 'id',
            ])
            ->add('eleves', EntityType::class, [
                'class' => Eleve::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LesParent::class,
        ]);
    }
}
