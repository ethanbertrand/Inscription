<?php

namespace App\Form\Eleve;

use App\Entity\Eleve;
use Symfony\Component\Form\Flow\AbstractFlowType;
use Symfony\Component\Form\Flow\FormFlowBuilderInterface;
use Symfony\Component\Form\Flow\Type\NavigatorFlowType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class EleveFlowType extends AbstractFlowType
{
    public function buildFormFlow(FormFlowBuilderInterface $builder, array $options): void
    {
        $builder->addStep('identite',    IdentiteType::class,    ['inherit_data' => true]);
        $builder->addStep('coordonnees', CoordoneeType::class, ['inherit_data' => true]);
        $builder->addStep('scolarite',   ScolariteType::class,   ['inherit_data' => true]);
        $builder->addStep('sante',       SanteType::class,       ['inherit_data' => true]);
        $builder->addStep('parents',     ParentType::class,     ['inherit_data' => true]);

        $builder->add('navigator', NavigatorFlowType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Eleve::class,
            'step_property_path' => 'currentStep',
        ]);
    }
}