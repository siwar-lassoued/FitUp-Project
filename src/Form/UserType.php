<?php

namespace App\Form;

use App\Entity\RDV;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Coach' => 'ROLE_COACH',
                    'User' => 'ROLE_USER',
                ],
                'multiple' => true, // Allow multiple roles
                'expanded' => true, // Render as checkboxes
            ])
            ->add('password')
            ->add('rDVs', EntityType::class, [ // Change 'rDV' to 'rDVs'
                'class' => RDV::class,
                'choice_label' => 'id',
                'multiple' => true, // Allow multiple selections
                'expanded' => true, // Optional: use checkboxes instead of a select box
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
