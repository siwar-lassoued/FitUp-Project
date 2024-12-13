<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => ['autocomplete' => 'email'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter an email address.',
                    ]),
                ],
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Coach' => 'ROLE_COACH',
                    'Client' => 'ROLE_CLIENT',
                ],
                'expanded' => true, // renders as radio buttons
                'multiple' => false, // ensures only one role can be selected
                'label' => 'Select Role',
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password.',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters.',
                        'max' => 4096,
                    ]),
                ],
            ]);

        // Optional: Add a CallbackTransformer if needed
        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($roleAsArray) {
                    // Transform array to a single string for form display
                    return is_array($roleAsArray) && count($roleAsArray) > 0 ? $roleAsArray[0] : null;
                },
                function ($roleAsString) {
                    // Transform single string back to array for the entity
                    return [$roleAsString];
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
