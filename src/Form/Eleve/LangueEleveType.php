<?php

namespace App\Form\Eleve;

use App\Entity\Langue;
use App\Entity\LangueEleve;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LangueEleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('langue', EntityType::class, [
                'class' => Langue::class,
                'choice_label' => 'Libelle',
                'label' => 'Langue',
                'placeholder' => 'Sélectionnez une langue',
            ])
            ->add('lv', ChoiceType::class, [
                'label' => 'Niveau',
                'choices' => ['LV1' => 1, 'LV2' => 2],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => LangueEleve::class]);
    }
}