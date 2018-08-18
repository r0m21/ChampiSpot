<?php

namespace App\Controller;


use App\Entity\CommentairesUser;
use App\Entity\User;
use App\Repository\CommentairesUserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\CommentType;

class UserController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        
        $comment = new CommentairesUser;
        $form = $this->createForm(CommentType::class, $comment);

        /* Récupère le repo */
        $repo = $this->getDoctrine()
        ->getRepository(User::class);
        $users = $repo->findAll();   
        
       
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',

        ]);
    }

    /**
     * @Route("/admin")
     */
    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }
    

    public function show(CommentairesUser $comment){
        

        return $this->render('comment/show.html.twig', [
            'controller_name' => 'UserController',
            'comment' => $comment,
            'commentForm' => $form->createView()
        ]);

    }

    /**
     * @Route("/profil/{id}", name="profil")
     */     

    public function profil($id){
        

        /* Récupère le repo */
        $repo = $this->getDoctrine()
        ->getRepository(User::class);
        $infosProfil = $repo->find($id);
        $photos = $infosProfil->getPhotoUsers();
        $comments = $infosProfil->getCommentairesUsers();
        $spots = $infosProfil->getSpots();
    

        dump($infosProfil);

        return $this->render('user/profil.html.twig', [
            'controller_name' => 'MapController',
            'infos' => $infosProfil,
            'photos' => $photos,
            'comments' => $comments,
            'spots' => $spots

        ]);
    }
}
