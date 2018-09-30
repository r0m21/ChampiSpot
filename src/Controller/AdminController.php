<?php

namespace App\Controller;

use App\Entity\Spot;
use App\Entity\Signalement;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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


        /* if(isset($_POST['delete']))
        {
            $id_spot = $_POST['idvalue'];
            $id_signal = $_POST['idsignal'];


            $repoSpot = $this->getDoctrine()
            ->getRepository(Spot::class);

            $signal = $repo->findById($id_signal);
            $spot = $repoSpot->findById($id_spot);
            dump($signal);
            dump($spot);

            //$manager->remove($signal[0]);
            $manager->remove($spot[0]);     

            $manager->flush();

        } */
        
        return $this->render('admin/admin.html.twig', [
            'signalement' => $signalement,
        
        ]);
    }
}
