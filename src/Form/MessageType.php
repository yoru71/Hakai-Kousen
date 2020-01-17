<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\IsTrue;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextareaType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un Contenue'
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre contenue doit contenir au moins {{ limit }} characteres',
                        'max' => 2500,
                        'maxMessage' => 'Votre contenue doit contenir au plus {{ limit }} characteres',
                    ]),
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Créer Le Message'   
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
