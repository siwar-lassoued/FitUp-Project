<?php

namespace App\Form;

use App\Entity\RDV;
use App\Entity\Coach;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RDVType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', null, [
                'widget' => 'single_text',
                'label' => 'Choose Date and Time',
            ])
            ->add('coach', EntityType::class, [
                'class' => Coach::class,
                'choice_label' => 'nom', // Assuming "name" is a field in the Coach entity
                'label' => 'Select a Coach',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RDV::class,
        ]);
    }
}
