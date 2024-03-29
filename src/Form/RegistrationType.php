<?php

namespace App\Form;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'attr' => [
                    'class' => 'form-control mt-4'
                ],'label' => 'Nom/Prénom',
                'label_attr' => [
                    'class'=> 'form-label mt-4'
                ]
            ])
            ->add('pseudo', TextType::class, [
                'attr' => [
                    'class' => 'form-control mt-4'
                ],'label' => 'Pseudo',
                'label_attr' => [
                    'class'=> 'form-label mt-4'
                ],'required' => false,
            ] )
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control mt-4'
                ],'label' => '@dresse email',
                'label_attr' => [
                    'class'=> 'form-label mt-4'
                ]
            ])
            ->add('plainPassword',  RepeatedType::class, [
                'type' => PasswordType::class,
                'attr' => [
                    'class' => 'form-control mt-4 text-primary'
                ],'label' => 'Saisir un mot de passe',
                'label_attr' => ['class'=> 'form-label mt-4 text-primary'],
                'first_options'  => ['label' => 'Mot de passe '],
                'second_options' => ['label' => 'Confirmer le mot de passe '],
            ])

            ->add('submit', submitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ],'label' => 'Créer votre compte !',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
