<?php

namespace App\Form\Eleve;

use App\Entity\ATransport;
use App\Entity\AssuranceScolaire;
use App\Entity\CentreSecuriteSocial;
use App\Entity\Classe;
use App\Entity\Commune;
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
class SanteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('medecin', EntityType::class, [
                'class' => Medecin::class,
                'choice_label' => 'id',
                'placeholder' => 'Sélectionnez un médecin',
            ])
            ->add('centreSecuriteSocial', EntityType::class, [
                'class' => CentreSecuriteSocial::class,
                'choice_label' => 'id',
                'placeholder' => 'Sélectionnez un centre de sécurité sociale',
            ])
            ->add('Date_Vaccin', DateType::class, ['widget' => 'single_text'])
            ->add('Remarque_sante');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Eleve::class]);
    }
}

