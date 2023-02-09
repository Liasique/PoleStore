<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Nom',
                'disabled' => true,
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Prenom',
                'disabled' => true,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'disabled' => true,
                ])
            ->add('old_password', PasswordType::class, [
                'mapped' => false,
                'label' => 'Mot de passe actuel',
                'attr' => [
                    'placeholder' => 'Veuillir saisir votre mot passe actuel',
                ]
            ])
            ->add('new_password', RepeatedType::class, [
                'mapped' => false,
                'type' => PasswordType::class,
                'invalid_message' => 'les daux mots passe ne correspondent pas ',
                'required' => true,
                'first_options' => [
                    'label' => 'Nouveau mot de passe', 
                    'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Veuillir saisir nouvelle mot de passe',
                    
                ]
                ] ,
                'second_options' => [
                    'label' => 'Confirmez votre nouveau mot de passe', 
                    'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Confirmez nouvelle mot de passe',
                    
                ]
                ] ,

                'constraints' => [
                    new NotNull([
                        'message' => 'Entrez un mot passe valide',
                    ]),
                    new Length([
                       'min' => 8,
                       'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caracteirs ',
                       'max' => 4096,
                    ])
                    ]
            ])

            ->add('submit', SubmitType::class,[
                'label' => 'Modifier', 
                'attr' => [
                'class' => 'btn btn-primary btn-block', 
                'placeholder' => 'Confirmez nouvelle mot de passe',
                
            ]
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
