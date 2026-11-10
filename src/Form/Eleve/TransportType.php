<?php

namespace App\Form\Eleve;

use App\Entity\Transport;
use App\Entity\TypeTransport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeTransport', EntityType::class, [
    'class' => TypeTransport::class,
    'label' => 'Type de transport',
    'choice_label' => 'Libelle',
    'placeholder' => 'Sélectionnez un type',
    'required' => false,
    'attr' => ['class' => 'js-type-transport'],
    'choice_attr' => fn (TypeTransport $t) => [
        'data-plaque' => $t->isImmatriculationRequise() ? '1' : '0',
        'data-ligne' => $t->isLigneUtile() ? '1' : '0',
    ],
])
->add('Ligne', TextType::class, [
    'label' => 'Ligne',
    'required' => false,
    'row_attr' => ['class' => 'js-row-ligne'],
])
            ->add('Immatriculation', TextType::class, [
                'label' => 'Immatriculation',
                'required' => false,
                'row_attr' => ['class' => 'js-row-plaque'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Transport::class]);
    }
}