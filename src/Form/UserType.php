<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'ADMIN' => 'ROLE_ADMIN',
                    'MANAGER' => 'ROLE_MANAGER',
                    'USER' => 'ROLE_USER',
                ],
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'help' => 'Le mot de passe doit contenir 8 caractères, 1 chiffre et un caractère spécial',
                'mapped' => false,
                'constraints' => [
                    new NotBlank(),
                    new Regex("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", "Le mot de passe est incorrect."),
                ]
            ])
            ->add('password_confirmed', PasswordType::class, [
                'label' => 'Confirmation mot de passe',
                'help' => 'veuillez confirmer le mot de passe',
                'mapped' => false,
                'constraints' => [
                    new NotBlank(),
                    new Regex(
                        '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                        'Les mots de passe ne sont pas identiques',
                    ),
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'attr' =>[
                'novalidate' => 'novalidate'
            ]
        ]);
    }
}
