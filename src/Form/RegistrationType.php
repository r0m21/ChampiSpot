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
            ->add('USE_role', HiddenType::class)

            ->add('confirm_password', PasswordType::class ,array(
                'attr' => array(
                'class' => 'input-1 browser-default'
                ),
            ))
            ->add('USE_profile_pic', FileType::class, array(
                'label' => ' ',
                'attr' => array(
                    "accept" => "image/*",
                    "class" => "d-none input-file",
                ),        
             ))
        ;
        $builder->get('USE_profile_pic')->setRequired(false);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
