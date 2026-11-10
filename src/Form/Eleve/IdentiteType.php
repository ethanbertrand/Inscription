<?php

namespace App\Form\Eleve;

use App\Entity\ATransport;
use App\Entity\AssuranceScolaire;
use App\Entity\CentreSecuriteSocial;
use App\Entity\Classe;
use App\Entity\Commune;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Eleve;
use App\Entity\LangueEleve;
use App\Entity\MDL;
use App\Entity\Medecin;
use App\Entity\Nationalite;
use App\Entity\NationaliteEleve;
use App\Entity\ParentsEleve;
use App\Entity\Regime;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
class IdentiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('Prenom')
            ->add('date_naissance', DateType::class, ['widget' => 'single_text'])
            ->add('Sexe', ChoiceType::class, [
                'choices' => [
                'Masculin' => 'Masculin',
                'Féminin' => 'Féminin',
                ],
                'expanded' => false,
                'placeholder' => false,
                ])
            ->add('photoFile', FileType::class, [
                'label' => 'Photo',
                'required' => false,
                'attr' => ['accept' => 'image/jpeg,image/png,image/webp'],
            ])
            ->add('Num_securite_social');
    }


}