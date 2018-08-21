<?php

namespace App\Controller;

use App\Entity\Signalement;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SignalementController extends Controller
{
    /**
     * @Route("/signalement", name="signalement")
     */
    public function ajoutSignalement(Request $request, ObjectManager $manager)
    {

        $newSignal = new Signalement();

        $form = $this->createForm(SignalType::class, $newSignal);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($newSignal);
            $manager->flush();

        }


        return $this->render('signalement/index.html.twig', [
            'formSignal' => $form->createView(),
        ]);
    }
}
