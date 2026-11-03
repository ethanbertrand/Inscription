<?php

namespace App\Form;

use App\Entity\Commune;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\BaseEntityAutocompleteType;

#[AsEntityAutocompleteField]
class CommuneAutocompleteType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'class' => Commune::class,
            'choice_label' => fn (Commune $commune): string =>
                $commune->getNom().' ('.$commune->getDepartement()?->getCode().')',
            'searchable_fields' => ['Nom', 'codeInsee'],
            'max_results' => 10,
            'min_characters' => 2,
            'preload' => false,
        ]);
    }

    public function getParent(): string
    {
        return BaseEntityAutocompleteType::class;
    }
}
