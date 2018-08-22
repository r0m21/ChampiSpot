<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
<<<<<<< HEAD
            ->add('username')
            ->add('USE_nom')
            ->add('USE_email')
            /* ->add('USE_profile_pic', FileType::class, array(
                'label' => 'Ajouter une photo de profil',
                'attr' => [
                    "accept" => "image/*",
                ]
             )) */
            ->add('password', PasswordType::class)
            ->add('confirm_password', PasswordType::class)
=======
            ->add('username', TextType::class ,array(
                'attr' => array(
                'class' => 'input-1 browser-default'
                ),
            ))
            ->add('USE_nom', TextType::class ,array(
                'attr' => array(
                'class' => 'input-1 browser-default'
                ),
            ))
            ->add('USE_email', TextType::class ,array(
                'attr' => array(
                'class' => 'input-1 browser-default'
                ),
            ))
            ->add('password', PasswordType::class ,array(
                'attr' => array(
                'class' => 'input-1 browser-default'
                ),
            ))
            ->add('confirm_password', PasswordType::class ,array(
                'attr' => array(
                'class' => 'input-1 browser-default'
                ),
            ))
            ->add('USE_profile_pic', FileType::class, array(
                'label' => 'Ajouter un avatar',
                'attr' => array(
                    "accept" => "image/*",
                    "class" => "d-none",
                ),        
             ))
>>>>>>> 67994848c2a19ba21f41a047b8c668395db143f1
        ;
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
