<?php

namespace App\Controller;

use App\Entity\Spot;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MapController extends Controller
{
    /**
     * @Route("/search", name="map")
     */
    public function search()
    {
        $repo = $this->getDoctrine()
        ->getRepository(Spot::class);

        $spots = $repo->findAll();
        
        dump($spots);
       

        return $this->render('map/search.html.twig', [
            'controller_name' => 'MapController',
            'spots' => $spots,
        ]);
    }

    
}
