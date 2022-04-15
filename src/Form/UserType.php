<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Pseudo *',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('roles', ChoiceType::class, [
                "label" => "Rôles",
                'choices' => [
                    'User' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN',
                ],
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('password', RepeatedType::class, [
                'label' => 'password',
                'type' => PasswordType::class,
                'first_options'  => ['label' => 'Mot de passe *'],
                'second_options' => ['label' => 'Confirmez le mot de passe *'],
                'invalid_message' => 'Les deux mots de passe doivent être identiques',
                'required' => false,
                'mapped' => false,
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom *',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom de Famille *',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('profil', TextareaType::class, [
                'label' => 'Profil *',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail *',
                'constraints' => [
                    new Email(),
                    new NotBlank(),
                ],
            ])
            ->add('github', UrlType::class, [
                'label' => 'Profil GitHub *',
                'constraints' => [
                    new NotBlank(),
                    new Url(),
                ]
            ])
            ->add('linkedin', UrlType::class, [
                'label' => 'Profil Linkedin *',
                'constraints' => [
                    new NotBlank(),
                    new Url(),
                ]
            ])
            ->add('twitter', UrlType::class, [
                'label' => 'Profil Twitter *',
                'constraints' => [
                    new NotBlank(),
                    new Url(),
                ]
            ])
            ->add('presentation', TextareaType::class, [
                'label' => 'Présentation *',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('image', UrlType::class, [
                'label' => 'Lien de l\'image *',
                'constraints' => [
                    new NotBlank(),
                    new Url(),
                ]
            ])
            ->add('age', DateType::class, [
                "widget" => 'single_text',
                'label' => 'Année de naissance *',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('projects', null, [
                'label' => 'Projets',
                'required' => false,
                'multiple' => true,
            ])
            ->add('softwares', null, [
                'label' => 'Softwares',
                'required' => false,
                'multiple' => true,
            ])
            ->add('operatingSystems', null, [
                'label' => 'OS',
                'required' => false,
                'multiple' => true,
            ])
            ->add('languages', null, [
                'label' => 'Dev Languages',
                'required' => false,
                'multiple' => true,
            ])
            ->add('databaseLanguages', null, [
                'label' => 'Database Languages',
                'required' => false,
                'multiple' => true,
            ])
            ->add('frameworks', null, [
                'label' => 'Frameworks',
                'required' => false,
                'multiple' => true,
            ])
            ->add('cms', null, [
                'label' => 'CMS',
                'required' => false,
                'multiple' => true,
            ])
            ->add('versionnings', null, [
                'label' => 'Versionnings',
                'required' => false,
                'multiple' => true,
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
