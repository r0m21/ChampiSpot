<?php

namespace App\Form;

use App\Entity\Champignon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ChampiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('CHA_espece', TextType::class, array(
                'label' => 'Espece',
                'attr' => array(
                    'class' => 'browser-default input-1 d-flex flex-column',
                ),
                    
                
            ))
            ->add('CHA_nom', TextType::class, array(
                'label' => 'Nom du champignon',
                'attr' => array(
                    'class' => 'browser-default input-1 d-flex flex-column',
                ),
            ))
            
            ->add('CHA_comestible', ChoiceType::class, array(
                'label' => 'Est-il comestible ?',
                'choices' => array(
                    'Oui' => 'oui',
                    'Non' => 'non',
                    'Peut-être' => 'peut-être',
                ),
                "expanded" => true,
                "multiple" => false,
                "attr" => array(
                    "class" => "browser-default",
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Champignon::class,
        ]);
    }
}
