<?php

namespace App\Controller;

use App\Entity\Spot;
use App\Entity\Signalement;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        $ignore = $_POST['ignore'];

        if($ignore->isSubmitted() && $ignore->isValid()){
            
            

        }
  

        $repo = $this->getDoctrine()
        ->getRepository(Signalement::class);
        $signalement = $repo->FindAll();
        dump($signalement);
        return $this->render('admin/admin.html.twig', [
            'signalement' => $signalement,
        
        ]);
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function delete()
    {}

    
}
