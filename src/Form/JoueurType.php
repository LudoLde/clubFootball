<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Joueur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class JoueurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class,[
                'attr' => [
                    'class' => 'form-control mt-4'
                ],'label' => 'Prénom'
            ])
            ->add('nom', TextType::class,[
                'attr' => [
                    'class' => 'form-control mt-4'
                ],'label' => 'Nom'
            ])
            ->add('age', IntegerType::class,[
                'attr' => [
                    'class' => 'form-control mt-4'
                ],'label' => 'Âge'
            ])
            ->add('numero', IntegerType::class,[
                'attr' => [
                    'class' => 'form-control mt-4'
                ],'label' => 'Numéro Maillot'
            ])
            ->add('poste', ChoiceType::class,[
                'attr' => [
                    'class' => 'form-control mt-4'
                ],'label' => 'Poste',
                'choices'  => [
                    'G' => 'G',
                    'DC' => 'DC',
                    'DG' => 'DG',
                    'DD' => 'DD',
                    'MG' => 'MG',
                    'MD' => 'MD',
                    'MC' => 'MC',
                    'MDef' => 'MDef',
                    'MO' => 'MO',
                    'AD' => 'AD',
                    'AG' => 'AG',
                    'AT' => 'AT',
                    'BU' => 'BU',
                ],'required' => false,
            ])
            ->add('dateNaissance', DateType::class, [
                'attr' => [
                    'class' => 'form-control mt-4'
                ], 'required' => false,
                'label' => 'Date de naissance',
                'widget' => 'single_text',
            ])
            ->add('nationalite', TextType::class,[
                'attr' => [
                    'class' => 'form-control mt-4'
                ],'label' => 'Nationalité'
            ])
           
            ->add('club', EntityType::class, [
                'class' => Club::class,
                'choice_label' => 'nom',
            ])

            ->add('submit', SubmitType::class, [
                 'attr' => [
                    'class' => 'btn btn-primary mt-4'
                 ],
                'label' => 'Créez votre joueur !'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Joueur::class,
        ]);
    }
}
