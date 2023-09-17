<?php

namespace App\Controller;

use App\Model\Fuel;
use App\Model\Photo;
use App\Model\Vehicule;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecondHandPagesController extends AbstractController
{
    #[Route('/occasions', name: 'app_second_hand_pages')]
    public function index(): Response
    {   
        $vehiculeModel = new Vehicule;
        $vehicules = $vehiculeModel->findAll();

        $photoModel = new Photo;
        foreach($vehicules as $index => $vehicule){
              $mainPicture = $photoModel->find($vehicule['mainpictureId']);
              $vehicules[$index]['mainPicture'] = $mainPicture['src'];
        }
        $fuelModel = new Fuel;
        foreach($vehicules as $index => $vehicule){
            $fuel = $fuelModel->find($vehicule['fuelId']);
            $vehicules[$index]['fuel'] = $fuel['type'];
        }
        if(isset($_SESSION) && !empty($_SESSION['Auth'])) {
            $auth = $_SESSION['Auth'];
        } else {
            $auth = '';
        }
        return $this->render('second_hand_pages/index.html.twig', [
            'auth' => $auth,
            'vehicules' => $vehicules
        ]);
    }
}
