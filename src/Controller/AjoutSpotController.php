<?php

namespace App\Controller;

use App\Entity\Spot;
use App\Entity\Champignon;


use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class AjoutSpotController extends Controller
{
    /**
     * @Route("/ajout", name="ajoutspot")
     */

    public function ajoutSpot(Request $request, ObjectManager $manager)
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');

        $newSpot = new Spot();
        
        $form = $this->createFormBuilder($newSpot)
                     ->add('SPO_photo')
                     ->add('SPO_accessibilite')
                     ->add('SPO_description')

                     /* ->add('SPO_id_champi', EntityType::class, array(
                        'class' => 'App\Entity\Champignon',
                        'choice_label' => 'id',
                     ))
 */
                    ->add('SPO_id_champi', EntityType::class, [
                        'label' => 'Champignon',
                        'class' => 'App\Entity\Champignon',
                        'choice_label' => function (Champignon $champignon) {
                            return $champignon->getCHANom();
                        },
                    ])
                    /*  ->add('SPO_id_champi', EntityType::class, array(
                        'class' => Champignon::class,
                        'choice_label' => 'CHANom',
                     ))
 */
                     ->add('SPO_id_user', EntityType::class, array(
                        'class' => 'App\Entity\User',
                        'choice_label' => 'id',
                     ))

                     ->add('SPO_longitude', HiddenType::class, [
                         'attr' => [
                             "id" => "getLng"
                         ]
                     ])

                     ->add('SPO_latitude', HiddenType::class, [
                        'attr' => [
                            "id" => "getLat"
                        ]
                    ])

                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($newSpot);
            $manager->flush();

        }

        return $this->render('ajout_spot/ajout.html.twig', [
            'formSpot' => $form->createView(),   
        ]);
    }
}
