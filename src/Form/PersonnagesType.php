<?php

namespace App\Form;

use App\Entity\Amis;
use App\Entity\Personnages;
use App\Entity\Qualidad;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            // ->add('surnom')
            ->add('image')
            ->add('typeId', EntityType::class, [
                'class' => Type::class,
                'label' => 'De quel type est le personnage ?',
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => true,
            ])
            // ->add('amibff', EntityType::class, [
            //     'class' => Amis::class,
            //     'choice_label' => 'name',
            //     'label' => 'Qui est son meilleur ami ?',
            //     'multiple' => false,
            //     'expanded' => true,
            // ])
            ->add('qualites', EntityType::class, [
                'class' => Qualidad::class,
                'choice_label' => 'adjectif',
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personnages::class,
        ]);
    }
}
