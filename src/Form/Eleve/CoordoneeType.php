<?php

namespace App\Form\Eleve;

use App\Entity\ATransport;
use App\Entity\AssuranceScolaire;
use App\Entity\CentreSecuriteSocial;
use App\Entity\Classe;
use App\Entity\Eleve;
use App\Form\CommuneAutocompleteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CoordoneeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Adresse')
            ->add('Commune_eleve', CommuneAutocompleteType::class, [
                'placeholder' => 'Rechercher une commune',
            ])
            ->add('Num_Tel')
            ->add('Num_tel_domicile')
            ->add('Tel_Urgence')
            ->add('Mail')
            ->add('accepte_sms', ChoiceType::class, [
                'choices' => [
                'Oui' => 'True',
                'Non' => 'False',
                ],
                'expanded' => false,
                'placeholder' => false,
                ]);
    }


}
