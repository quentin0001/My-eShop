<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email', 
                'constraints' => [
                    new NotBlank([
                        'message' => 'ce champ ne peut être vide',

                    ]),
                    new length([                       
                        'max' => 180,
                        'maxMessage' => 'Votre email ne peut dépasser {{ limit }} caractères',                        
                    ]),
                    new Email([
                        'message' => 'votre email n\'est pas au bon format ex. mail@example.com'
                    ]),
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'constraints' => [
                    new NotBlank([
                        'message' => 'ce champ ne peut être vide',

                    ]),
                    new length([                       
                        'max' => 255,
                        'min' => 4,
                        'maxMessage' => 'Votre mot de passe ne peut dépasser {{ limit }} caractères', 
                        'minMessage' => 'Votre mot de passe ne peut dépasser {{ limit }} caractères',                        
                    ]),
                ],
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'constraints' => [
                    new NotBlank([
                        'message' => 'ce champ ne peut être vide',
                    ]),
                    new Length([
                        'max' => 50,
                        'min' => 2,
                        'maxMessage' => 'Votre prénom ne peut dépasser {{ limit }} caractères',
                        'minMessage' => 'Votre prénom doit avoir un minimun {{ limit }} caractères ',
                    ])
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'constraints' => [
                    new NotBlank([
                        'message' => 'ce champ ne peut être vide',

                    ]),
                    new length([                       
                        'max' => 50,
                        'min' => 2,
                        'maxMessage' => 'Votre nom ne peut dépasser {{ limit }} caractères', 
                        'minMessage' => 'Votre nom ne peut dépasser {{ limit }} caractères',                        
                    ]),
                ],
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'Civilité',
                'expanded' => true,
                'choices' => [
                    'homme' => 'h',
                    'Femme' => 'f'
                ],
                'attr' => [
                    'class' => '',
                ],
                'attr' => [
                    'class' => 'd-flex gap-3'
                ], 
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir un genre',

                    ]),
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                // Cette option permet de désactiver le validator HTML (front)
                // # => form_start(form, {'attr' : {'novalidate': novalidate}})
                'validate' => false,
                'attr' => [
                    'class' => 'd-block mx auto col-2 btn btn-primary'
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
