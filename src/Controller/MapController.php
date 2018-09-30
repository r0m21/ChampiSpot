<?php

namespace App\Controller;

use App\Entity\Spot;
use App\Entity\User;
use App\Entity\Champignon;
use App\Entity\Signalement;
use App\Entity\CommentairesUser;

use App\Form\CommentType;

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

        $repoComment = $this->getDoctrine()
        ->getRepository(CommentairesUser::class);
        
        $spots = $repo->find($id);  
        
        $comment = $repoComment -> findBy([
            "COM_id_spot" => $spots,
        ], 
        [ 'id' => 'DESC'],
         3);

        $thisAuthor = $spots->getSPOIdUser();

        $thisChampi = $spots->getSPOIdChampi()->getCHAComestible();

        /* $comment = $spots->getCommentairesUsers(); */

        $newSignal = new Signalement();

        $form = $this->createFormBuilder($newSignal)
                     
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

            $userId = $user->getId(); 

            $repo = $this->getDoctrine()
            ->getRepository(User::class);
            $users = $repo->find($userId);

            $newSignal->setSIGIdUser($users);
            $newSignal->setSpot($spots);

            $manager->persist($newSignal);
            $manager->flush();

        }

        /* Formulaire d'ajout de commentaire */
                
        $newComment = new CommentairesUser();

        $form_comment = $this->createForm(CommentType::class, $newComment);

        $form_comment->handleRequest($request);

        if($form_comment->isSubmitted() && $form_comment->isValid()){

            $userId = $user->getId();

            $repo = $this->getDoctrine()
            ->getRepository(User::class);
            $users = $repo->find($userId);

            $newComment->setCOMIdSpot($spots);
            $newComment->setCOMIdUser($users);

            $manager->persist($newComment);
            $manager->flush();


        }

        return $this->render('map/search.html.twig', [
            'spots' => $spots,
            'comment' => $comment,
            'author' => $thisAuthor,
            'champi' => $thisChampi,
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

    
    /**
     * @Route("/a-propos", name="a-propos")
     */
    public function aPropos()
    {
        return $this->render('a_propos/a_propos.html.twig', [
            
        ]);
    }

    
}
