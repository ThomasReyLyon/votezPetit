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
            ->add('titre')
            ->add('sommaire')
            ->add('contenu')
            ->add('budget')
            //->add('createdAt')
            //->add('deadline')
            //->add('isOuverte')
            //->add('isValide')
            //->add('nombreVotes')
            ->add('categorie', EntityType::class, [
              'class'=> Categories::class,
              'choice_label'=>'nom',
              'multiple'=>false,
              'by_reference'=>false
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
