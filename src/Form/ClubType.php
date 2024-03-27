<?php

namespace App\Form;

use App\Entity\Club;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class ClubType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom du club:',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                   new Assert\Length(min: 3, max: 60, minMessage:"Le nom du club doit comporter au moins 3 caractères."),
                   new Assert\NotBlank()
                ]
            ])
            ->add('pays', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Pays:',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(min: 3, max: 60),
                    new Assert\NotBlank()
                ]
                ])
            ->add('budget', IntegerType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Budget 💰:',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Positive(),
                    new Assert\GreaterThanOrEqual(100000),
                    new Assert\NotBlank()
                ]
                ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ],
                'label' => 'Créez votre nouveau club ⚽️!'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Club::class,
        ]);
    }
}
