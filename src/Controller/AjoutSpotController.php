<?php

namespace App\Controller;

use App\Entity\Spot;
use App\Form\SpotType;
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
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');

        $newSpot = new Spot();
        
        $form = $this->createForm(SpotType::class, $newSpot);

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
