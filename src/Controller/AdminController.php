<?php

namespace App\Controller;

use App\Entity\Spot;
use App\Entity\Signalement;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Doctrine\Common\Persistence\ObjectManager;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function admin(Request $request, ObjectManager $manager)
    {
        $repo = $this->getDoctrine()
        ->getRepository(Signalement::class);
        $signalement = $repo->FindAll();
        $repoSpot = $this->getDoctrine()
        ->getRepository(Spot::class);
        

        if(isset($_POST['delete'])){
            $spotId = $_POST['spotId'];
            $findSpot = $repoSpot->findById($spotId);
            $thisSpot = $findSpot[0];
            dump($thisSpot);
            $manager->remove($thisSpot);
            $manager->flush();            
        }
        else if(isset($_POST['signal'])){
            $sigId = $_POST['sigId'];
            $findSig = $repo->findById($sigId);
            $thisSig = $findSig[0];
            dump($thisSig);
            $manager->remove($thisSig);
            $manager->flush();
        }
        return $this->render('admin/admin.html.twig', [
            'signalement' => $signalement,
        
        ]);
    }
}
