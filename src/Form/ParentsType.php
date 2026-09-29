<?php

namespace App\Form;

use App\Entity\Parents;
use App\Entity\ParentsEleve;
use App\Entity\Statut;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('Prenom')
            ->add('Adresse')
            ->add('tel_fixe')
            ->add('tel_portable')
            ->add('tel_entreprise')
            ->add('Poste')
            ->add('statut_parents', EntityType::class, [
                'class' => Statut::class,
                'choice_label' => 'id',
            ])
            ->add('statut', EntityType::class, [
                'class' => Statut::class,
                'choice_label' => 'id',
            ])
            ->add('parentsEleve', EntityType::class, [
                'class' => ParentsEleve::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Parents::class,
        ]);
    }
}
