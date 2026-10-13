<?php

namespace App\Form\Eleve;

use App\Entity\ATransport;
use App\Entity\AssuranceScolaire;
use App\Entity\CentreSecuriteSocial;
use App\Entity\Classe;
use App\Entity\Commune;
use App\Entity\Eleve;
use App\Entity\Etablissement;
use App\Entity\LangueEleve;
use App\Entity\MDL;
use App\Entity\Medecin;
use App\Entity\Nationalite;
use App\Entity\NationaliteEleve;
use App\Entity\ParentsEleve;
use App\Entity\Regime;
use App\Entity\SecuriteSocial;
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
            ->add('medecin_eleve', EntityType::class, [
                'class' => Medecin::class,
                'choice_label' => 'id',
                'placeholder' => 'Sélectionnez un médecin',
            ])
            ->add('secu_eleve', EntityType::class, [
                'class' => SecuriteSocial::class,
                'choice_label' => 'id',
                'placeholder' => 'Sélectionnez un centre de sécurité sociale',
            ])
            ->add('date_vaccin', DateType::class, ['widget' => 'single_text'])
            ->add('Remarque_sante');
    }


}
