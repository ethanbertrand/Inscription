<?php

namespace App\Form;

use App\Entity\Eleve;
use App\Entity\Nationalite;
use App\Entity\NationaliteEleve;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NationaliteEleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nationalite_pays', EntityType::class, [
                'class' => Nationalite::class,
                'choice_label' => 'id',
            ])
            ->add('eleve_nation', EntityType::class, [
                'class' => Eleve::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NationaliteEleve::class,
        ]);
    }
}
