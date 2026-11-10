<?php

namespace App\Form;

use App\Entity\ATransport;
use App\Entity\Transport;
use App\Entity\TypeTransport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Ligne', null, [
                'required' => false,
            ])
            ->add('Immatriculation', null, [
                'required' => false,
            ])
            ->add('typeTransport', EntityType::class, [
                'class' => TypeTransport::class,
                'choice_label' => 'libelle',
            ])
            ->add('auntransport', EntityType::class, [
                'class' => ATransport::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transport::class,
        ]);
    }
}
