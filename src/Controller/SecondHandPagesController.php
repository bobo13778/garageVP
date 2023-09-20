<?php

namespace App\Controller;

use App\Model\Horaire;
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

        $scheduleModel = new Horaire;
        $schedules = $scheduleModel->findAll();


        if(isset($_SESSION) && !empty($_SESSION['Auth'])) {
            $auth = $_SESSION['Auth'];
        } else {
            $auth = '';
        }
        return $this->render('second_hand_pages/index.html.twig', [
            'auth' => $auth,
            'vehicules' => $vehicules,
            'schedules' => $schedules
        ]);
    }
}
