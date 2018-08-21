<?php

namespace App\Controller;

use App\Entity\Spot;
use App\Entity\CommentairesUser;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class MapController extends Controller
{
    /**
     * @Route("/search/{id}", name="search")
     */
    public function search($id)
    {
        
        /* Récupère le repo */
        $repo = $this->getDoctrine()
        ->getRepository(Spot::class);
        $spots = $repo->find($id);
        $comment = $spots->getCommentairesUsers();
        $longitude = $repo->find($id)->getSPOLongitude();
        $latitude = $repo->find($id)->getSPOLatitude();
        



        return $this->render('map/search.html.twig', [
            'controller_name' => 'MapController',
            'spots' => $spots,
            'comment' => $comment,
            'longitude' => $longitude,
            'latitude' => $latitude

        ]);
    }

    /**
     * @Route("/map", name="map")
     */
    public function map()
    {
        
        /* Récupère le repo */
        $repo = $this->getDoctrine()
        ->getRepository(Spot::class);
        $spots = $repo->findAll();

        return $this->render('map/map.html.twig', [
            'controller_name' => 'MapController',
            'spots' => $spots,
           
        ]);
    }

    
}
