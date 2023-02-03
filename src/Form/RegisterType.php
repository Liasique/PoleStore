<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder

            ->add('firstname', TextType::class, [
                'label' => 'Votre nom',
               'required'  => false,
                'attr'  => [
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new NotNull([
                        'message' => 'veuillez entre votre nom.'
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre nom doit comporte au moins {{ limit }} caractéres.',
                        'max' => 4096,

                    ])
                ]
            ])

            ->add('lastname', TextType::class, [
                'label' => 'Votre prénom',
               'required'  => false,
                'attr'  => [
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new NotNull([
                        'message' => 'Veuillez entre votre prénom.'
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre prénom doit comporte au moins {{ limit }} caractéres.',
                        'max' => 4096,
                    ])
                ]
            ])

            ->add('email', EmailType::class, [
                'label' => 'Votre adress email',
               'required'  => false,
                'attr'  => [
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new NotNull([
                        'message' => 'Adresse email requise.'
                    ]),
                    // new Length([
                    //     'min' => 6,
                    //     'minMessage' => 'Votre prénom doit comporte au moins {{ limit }} caractéres.', 
                    //     'max' => 4096,
                    // ])
                    new Email([
                        'message' => 'Veuillez entre une adresse email valid.'
                    ])
                ]
            ])

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les deux mots de passes ne corresponde pas.',
                'label' => 'Mot de passe',
               'required'  => false,
                'attr'  => [
                    'class' => 'form-control'
                ],
                'first_options' =>[
                    'label' => 'Entreez votre mot passe',
                    'attr'  => [
                        'placeholder' =>'Entrez votre mot passe',
                        'class' => 'form-control',
                    ],
                ],
                'second_options' =>[
                    'label' => 'Confirmez votre mot passe',
                    'attr'  => [
                        'placeholder' =>'Confirmez votre mot passe',
                        'class' => 'form-control',
                    ],
                ],
                'constraints' => [
                    new NotNull([
                        'message' => 'Veuillez entre un mot passe.'
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre mot de passe  doit comporte au moins {{ limit }} caractéres.',
                        'max' => 4096,
                    ])
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire",
                'attr'  => [
                    'class' => 'btn btn-primary mt-3',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
