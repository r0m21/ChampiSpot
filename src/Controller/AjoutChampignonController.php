<?php

namespace App\Controller;

use App\Form\ChampiType;
use App\Entity\Champignon;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AjoutChampignonController extends Controller
{
    /**
     * @Route("/ajout-champignon", name="ajout_champignon")
     */
    public function ajoutChampignon(Request $request, ObjectManager $manager, UserInterface $user)
    {
        $userId = $user->getId(); 


        $newChampi = new Champignon();
        
        $form = $this->createForm(ChampiType::class, $newChampi);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($newChampi);
            $manager->flush();

        }

        return $this->render('ajout_champignon/ajout.html.twig', [
            'formChampi' => $form->createView(),
            'userId' => $userId,   
        ]);
    }
}
