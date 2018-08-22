<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends Controller
{

    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, ObjectManager $manager,
    UserPasswordEncoderInterface $encoder){

        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            // $photo récupère le fichier uploadé
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $photo */

            $photo = $form->get('USE_profile_pic')->getData();

            $photoName = $this->generateUniqueFileName().'.'.$photo->guessExtension();

            // déplace le fichier là où doit êtrs stocké
            $photo->move(
                $this->getParameter('profile_directory'),
                $photoName
            );

            // updates the 'photo' property to store the photo file name
            // instead of its contents

            $newSpot->setSPOPhoto($photoName);

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute("security_login");
        }
    
        return $this->render('security/registration.html.twig', [

            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/connexion", name="security_login")
     */
    public function login(){
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout(){
        
    }
}
