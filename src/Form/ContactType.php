<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    // On utilise les propriétés de l'entité Contact qu'on a créée au préalable
    // Le $builder nous permet de créer un formulaire avec les champs voulus
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Ceci est notre gabarit de formulaire, avec tous ses champs
        $builder
            ->add('name')
            ->add('firstname')
            ->add('email')
            ->add('phone')
            ->add('message')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
