<?php

namespace App\Controller;

use App\Entity\Spot;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AjoutSpotController extends Controller
{
    /**
     * @Route("/ajout", name="ajout_spot")
     */

    public function ajoutSpot(Request $request, ObjectManager $manager)
    {
        $newspot = new Spot();

        $form = $this->createFormBuilder($newspot)
                     ->add('CHA_espece')
                     ->add('CHA_comestible')
                     ->add('SPO_description')
                     ->add('SPO_accessibilite')
                     ->add('SPO_photo')
                     ->getForm();

        return $this->render('ajout/ajout.html.twig', [
            'formSpot' => $form->createView()
        ]);
    }
}