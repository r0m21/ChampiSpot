<?php

namespace App\Controller;

use App\Entity\Spot;
use App\Entity\User;


use App\Entity\Champignon;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AjoutSpotController extends Controller
{
    /**
     * @Route("/ajout", name="ajoutspot")
     */

    public function ajoutSpot(Request $request, ObjectManager $manager, UserInterface $user)
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');
        
        $newSpot = new Spot();
        $userId = $user->getId();

        $form = $this->createFormBuilder($newSpot)
                     ->add('SPO_photo', HiddenType::class, array(
                        'label' => 'Ajouter une photo',
                     ))
                     ->add('SPO_accessibilite', IntegerType::class, array(
                        'label' => 'Accessibilité',
                        'attr' => [
                            'min' => '1',
                            'max' => '5',
                            'placeholder' => '1 à 5',
                            'class' => ' color-2 border-1 browser-default input-1 d-flex flex-column mt-10 mb-10',
                        ]
                     ))
                     ->add('SPO_description', TextareaType::class, array(
                        'label' => 'Description',
                        'attr' => [
                            'class' => 'border-1 browser-default input-1 d-flex flex-column h-100px p-10 mt-10 mb-10',
                        ]
                     ))

                     ->add('SPO_id_champi', EntityType::class, array(
                        'class' => 'App\Entity\Champignon',
                        'choice_label' => 'id',
                        'attr' => [
                            'class' => 'browser-default input-1',
                        ]
                     ))

                    ->add('SPO_id_user', EntityType::class, array(
                        'label' => 'ID',
                        'class' => User::class,
                        'attr' => array(
                            "class" => $user->getId(),   
                        ),
                    ))

                     ->add('SPO_id_champi', EntityType::class, array(
                        'label' => 'Champignon',
                        'class' => Champignon::class,
                        'choice_label' => 'CHANom',
                        'attr' => [
                            "class" => "border-1 browser-default input-1  d-flex flex-column mt-10 mb-20"
                        ]
                     ))
                     ->add('SPO_id_user', HiddenType::class)
                        
     
                    

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

           

            $repo = $this->getDoctrine()
            ->getRepository(User::class);
            $users = $repo->find($userId);
            
            $upload_dir = "uploads/photos/";
            $photo = $form->get('SPO_photo')->getData();
            $photoname = str_replace('data:image/png;base64,', '', $photo);
            $photoname = str_replace(' ', '+', $photoname);
            $data = base64_decode($photoname);
            // déplace le fichier là où doit êtrs stocké
            $file = $upload_dir . md5($data) . ".png";
            $success = file_put_contents($file, $data);
            move_uploaded_file($success, $upload_dir);
            // updates the 'photo' property to store the photo file name
            // instead of its contents

            $newSpot->setSPOIdUser($users);
            $newSpot->setSPOPhoto($file);

            $manager->persist($newSpot);
            $manager->flush();

        }
        
        return $this->render('ajout_spot/ajout.html.twig', [
            'formSpot' => $form->createView(),
            'userId' => $userId   
        ]);
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
    public function fooAction(UserInterface $user)
    {
        $userId = $user->getId(); 
        dump($userId);
    }
}
