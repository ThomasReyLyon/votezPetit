<?php

namespace App\Form;

use App\Entity\Problems;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Problems1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Type')
            ->add('address')
            ->add('zipCode')
            ->add('city')
            ->add('validations')
            ->add('isSolved')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Problems::class,
        ]);
    }
}
