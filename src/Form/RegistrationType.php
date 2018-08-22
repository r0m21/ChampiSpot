<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
        ;
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
