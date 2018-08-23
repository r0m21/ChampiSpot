<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\CommentType;
use App\Entity\CommentairesUser;
use App\Repository\CommentairesUserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index(UserInterface $user)
    {
        
        $comment = new CommentairesUser;
        $form = $this->createForm(CommentType::class, $comment);

        /* Récupère le repo */
        $repo = $this->getDoctrine()
        ->getRepository(User::class);
        $users = $repo->findAll();   
        
        $userId = $user->getId(); 

       
        return $this->render('user/index.html.twig', [
            'userId' => $userId,
        ]);
    }

    /**
     * @Route("/admin")
     */
    public function admin()
    {
        return $this->render('admin/admin.html.twig', [
            
        ]);
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

    public function profil($id, UserInterface $user){
        
        /* Récupère le repo */
        $repo = $this->getDoctrine()
        ->getRepository(User::class);

        $userId = $user->getId(); 


        $infosProfil = $repo->find($id);
        $photos = $infosProfil->getPhotoUsers();
        $comments = $infosProfil->getCommentairesUsers();
        $spots = $infosProfil->getSpots();
        $spotsNumber = $spots->count($id);
        

        return $this->render('user/profil.html.twig', [
            'infos' => $infosProfil,
            'photos' => $photos,
            'comments' => $comments,
            'spots' => $spots,
            'userId' => $userId,
            'spotsNumber' => $spotsNumber,

        ]);
    }
}
