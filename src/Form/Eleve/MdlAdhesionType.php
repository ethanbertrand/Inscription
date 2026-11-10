<?php

namespace App\Form\Eleve;

use App\Entity\MDL;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MdlAdhesionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Adhesion', CheckboxType::class, [
                'label' => 'Adhère à la MDL',
                'required' => false,
            ])
            ->add('Cheque', TextType::class, [
                'label' => 'Chèque',
                'required' => false,
                'row_attr' => ['class' => 'js-row-mdl'],
            ])
            ->add('photoFile', FileType::class, [
    'label' => 'Photo',
    'required' => false,
    'attr' => ['accept' => 'image/jpeg,image/png,image/webp'],
    'row_attr' => ['class' => 'js-row-mdl'],
]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => MDL::class]);
    }
}