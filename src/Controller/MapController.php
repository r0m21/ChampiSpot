<?php

namespace App\Controller;

use App\Entity\Spot;
use App\Entity\User;
use App\Form\CommentType;
use App\Entity\Champignon;
use App\Entity\Signalement;

use App\Entity\CommentairesUser;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class MapController extends Controller
{
    /**
     * @Route("/search/{id}", name="search")
     */
    public function search($id, Request $request, ObjectManager $manager, UserInterface $user)
    {
        $userId = $user->getId();

        /* Récupère le repo */
        $repo = $this->getDoctrine()
        ->getRepository(Spot::class);
        $spots = $repo->find($id);
        
        $comment = $spots->getCommentairesUsers();
        $longitude = $repo->find($id)->getSPOLongitude();
        $latitude = $repo->find($id)->getSPOLatitude();

        $newSignal = new Signalement();

        $form = $this->createFormBuilder($newSignal)

                    ->add('SIG_id_user', EntityType::class, array(
                        'class' => 'App\Entity\User',
                        'choice_label' => 'id',
                    ))

                    ->add('sig_id_spot_id', EntityType::class, array(
                        'class' => Spot::class,
                        'choice_label' => 'id',
                    ))
                     
                    ->add('SIG_vide', ChoiceType::class, array(
                        'choices' => array(
                            'Oui' => 'oui',
                            'Non' => 'non',
                        ),
                        "expanded" => true,
                        "multiple" => false,
                        "attr" => array(
                            "name" => "group1",
                        ))

                    )
                    ->add('SIG_toxique', ChoiceType::class, array(
                        'choices' => array(
                            'Oui' => 'oui',
                            'Non' => 'non',
                        ),
                        "expanded" => true,
                        "multiple" => false,
                        "attr" => array(
                            "class" => "browser-default",
                        ))

                    )

                    ->add('SIG_desc', ChoiceType::class, array(
                        'choices' => array(
                            'Oui' => 'oui',
                            'Non' => 'non',
                        ),
                        "expanded" => true,
                        "multiple" => false,
                        "attr" => array(
                            "class" => "browser-default",
                        ))

                    )

                    ->add('SIG_accessibilite', ChoiceType::class, array(
                        'choices' => array(
                            'Oui' => 'oui',
                            'Non' => 'non',
                        ),
                        "expanded" => true,
                        "multiple" => false,
                        "attr" => array(
                            "class" => "browser-default",
                        ))

                        
                    )

                    ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($newSignal);
            $manager->flush();

            dump($newSignal);

        }

        /* Formulaire d'ajout de commentaire */
                
        $newComment = new CommentairesUser();
        $form_comment = $this->createForm(CommentType::class, $newComment);

        $repo_com = $this->getDoctrine()
        ->getRepository(CommentairesUser::class);
        
        $id_spot = $repo_com->find($spots)->getCOMIdSpot();
        $id_user = $repo_com->find($userId)->getCOMIdUser();

        $form_comment->handleRequest($request);

        if($form_comment->isSubmitted() && $form_comment->isValid()){

            $manager->persist($newComment);
            $manager->flush();

            dump($newComment);

        }

        return $this->render('map/search.html.twig', [
            'spots' => $spots,
            'comment' => $comment,
            'longitude' => $longitude,
            'latitude' => $latitude,
            'formSignal' => $form->createView(),
            'formComment' => $form_comment->createView(),
        ]);
    }


    /**
     * @Route("/", name="map")
     */

    public function map()
    {
      
        /* Récupère le repo */
        $repo = $this->getDoctrine()
        ->getRepository(Spot::class);
       
        $repoChampis = $this->getDoctrine()
        ->getRepository(Champignon::class);

        if(isset($_POST['submitFilter'])){
            $espece = $_POST['filter'];
            if ($espece != 'Default'){
                $spots = $repo
                ->findBy(array('SPO_id_champi' => $espece));
            }
            dump($spots);
       
        }else
        {
            $spots = $repo->findAll();
        }

        $allChampis = $repoChampis->findAll();

        return $this->render('index.html.twig', [
            'spots' => $spots,
            'allChampis' => $allChampis,           
           
        ]);
    }

    
}
