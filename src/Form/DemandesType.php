<?php

namespace App\Form;

use App\Entity\Demandes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('sommaire')
            ->add('contenu')
            ->add('budget')
            ->add('createdAt')
            ->add('deadline')
            ->add('isOuverte')
            ->add('isValide')
            ->add('nombreVotes')
            ->add('categorie')
            ->add('createur')
            ->add('voteurs')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Demandes::class,
        ]);
    }
}
