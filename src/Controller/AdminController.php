<?php

namespace App\Controller;

use App\Entity\Spot;
use App\Entity\Signalement;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function admin(Request $request, $id)
    {
        $repo = $this->getDoctrine()
        ->getRepository(Signalement::class);
        $signalement = $repo->FindAll();
        
        return $this->render('admin/admin.html.twig', [
            'signalement' => $signalement,
        
        ]);
    }
}
