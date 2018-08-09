<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MapController extends Controller
{
    /**
     * @Route("/search", name="map")
     */
    public function search()
    {
        return $this->render('map/search.html.twig', [
            'controller_name' => 'MapController',
        ]);
    }
}
