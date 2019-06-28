<?php

namespace App\Form;

use App\Entity\Problems;
use function PHPSTORM_META\type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Problems1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Type', ChoiceType::class, [
                'choices' => [
                    'Nid de poule' => 'Nid de poule',
                    'Caniveau bouché' => 'Caniveau bouché',
                    'Éclairage défectueux' => 'Éclairage défectueux',
                    'Grafiti' => 'Grafiti',
                    'Ordures répandues' => 'Ordures répandues',
                    'Déjections canines' => 'Déjections canines'
                ]
            ])
            ->add('address')
            ->add('zipCode')
            ->add('city')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Problems::class,
        ]);
    }
}
