<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Demandes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', null, [
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Titre'
                ],
                'label' => false,
            ])
            ->add('sommaire', null, [
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Sommaire'
                ],
                'label' => false,
            ])
            ->add('contenu', null, [
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Contenu'
                    ],
                'label' => false,
            ])
            ->add('budget', null, [
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Budget'
                ],
                'label' => false,
            ])
            //->add('createdAt')
            //->add('deadline')
            //->add('isOuverte')
            //->add('isValide')
            //->add('nombreVotes')
            ->add('categorie', EntityType::class, [
              'class'=> Categories::class,
              'choice_label'=>'nom',
              'by_reference'=>false,
                'label' => false,
              ])

            //->add('createur')
            //->add('voteurs')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Demandes::class,
        ]);
    }
}
