<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email', 
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'Civilité',
                'expended' => true,
                'choices' => [
                    'homme' => 'h',
                    'Femme' => 'f'
                ],
                'attr' => [
                    'class' => '',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                // Cette option permet de désactiver le validator HTML (front)
                // # => form_start(form, {'attr' : {'novalidate': novalidate}})
                'validate' => false,
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
