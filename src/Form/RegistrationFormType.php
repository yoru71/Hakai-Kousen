<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudonyme', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un pseudonyme',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre Pseudonyme doit contenir au moins {{ limit }} characteres',
                        // max length allowed by Symfony for security reasons
                        'max' => 25,
                        'maxMessage' => 'Votre Pseudonyme doit contenir au plus {{ limit }} characteres',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un email',
                    ]),
                    new Email([
                        'message' => 'Votre email doit être valide'
                    ]),
                ],
            ])
            
            ->add('password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} characteres',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                        'maxMessage' => 'Votre mot de passe doit contenir au maximum {{ limit }} characteres',
                    ]),
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Inscription',
                'attr' => [
                    'class' => 'btn btn-danger col-12 text-center'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
