<?php

namespace App\Controller;


use App\Entity\CommentairesUser;
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
               

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            /* 'comment' => $comment,
            'commentForm' => $form->createView() */
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
}
