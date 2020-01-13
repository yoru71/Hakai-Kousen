<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Title', TextType::class, [
                'label' => 'Titre',
                'constraints' => [

                    new NotBlank([
                        'message' => 'Merci de renseigner un nom titre' 
                    ]),
                    new Length([
                        'min' => 2, 
                        'minMessage' => 'Le titre doit contenir au moins {{ limit }} caractères', 
                        'max' => 50, 
                        'maxMessage' => 'Le titre doit contenir au maximum {{ limit }} caractères'
                    ]),
                ]
            ])
            ->add('Objet', TextType::class, [
                'label' => 'Objet',
                'constraints' => [

                    new NotBlank([
                        'message' => 'Merci de renseigner un objet' 
                    ]),
                    new Length([
                        'min' => 2, 
                        'minMessage' => 'L\'objet doit contenir au moins {{ limit }} caractères', 
                        'max' => 50, 
                        'maxMessage' => 'L\'objet doit contenir au maximum {{ limit }} caractères'
                    ]),
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenue',
                'constraints' => [

                    new NotBlank([
                        'message' => 'Merci de renseigner un contenue' 
                    ]),
                    new Length([
                        'min' => 50, 
                        'minMessage' => 'Le contenue doit contenir au moins {{ limit }} caractères', 
                        'max' => 1000, 
                        'maxMessage' => 'Le contenue doit contenir au maximum {{ limit }} caractères'
                    ]),
                ]
            ])
            ->add('save', SubmitType::class, [ 
                'label' => 'Créer article'    
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
