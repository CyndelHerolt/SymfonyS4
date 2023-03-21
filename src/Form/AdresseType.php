<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('adresse1', TextType::class, [
                'label' => 'Adresse',
                'help' => 'Numéro, rue',
                'attr' => ['class' => 'form-control'],
                'constraints' => [new NotBlank(message: 'Veuillez renseigner ce champ')],
            ])
            ->add('adresse2', TextType::class, [
                'label' => 'Complément d\'adresse',
                'help' => 'Bâtiment, étage, appartement',
                'attr' => ['class' => 'form-control']
            ])
            ->add('codePostal', TextType::class, [
                'label' => 'Code postal',
                'attr' => ['class' => 'form-control'],
                'constraints' => [new Length(min: 5, max: 5, exactMessage: 'Le code postal doit comporter 5 chiffres')],
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville',
                'attr' => ['class' => 'form-control'],
                'constraints' => [new NotBlank(message: 'Veuillez renseigner ce champ')],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
