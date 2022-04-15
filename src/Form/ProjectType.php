<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre *',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut être vide',
                    ]),
                ],
            ])
            ->add('summary', TextareaType::class, [
                'label' => 'Résumé *',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description *',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('github', TextType::class, [
                'label' => 'Lien Github *',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut être vide',
                    ]),
                ],
            ])
            ->add('url', TextType::class, [
                'label' => 'Lien du site *',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut être vide',
                    ]),
                ],
            ])
            ->add('image', TextType::class, [
                'label' => 'Lien de l\'image *',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut être vide',
                    ]),
                ],
            ])
            ->add('categories', null, [
                'label' => 'Catégories',
                'required' => false,
                'multiple' => true,
            ])
            ->add('user', null, [
                'label' => 'Utilisateur',
                'required' => false,
                'multiple' => false,
            ])
              ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
