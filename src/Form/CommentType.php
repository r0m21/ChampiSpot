<?php

namespace App\Form;

use App\Entity\CommentairesUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('COM_text', TextareaType::class, array(
                'empty_data' => '',
                
                'attr' => array(
                    'class' => "h-100px p-10",
                    'placeholder' => "Écrire un commentaire",
                ),
            ))
            ->add('COM_id_user', HiddenType::class)
            ->add('COM_id_spot', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommentairesUser::class,
        ]);
    }
}
