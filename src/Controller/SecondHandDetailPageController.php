<?php

namespace App\Controller;

use App\Model\Fuel;
use App\Model\Horaire;
use App\Model\Photo;
use App\Model\Vehicule;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecondHandDetailPageController extends AbstractController
{
    #[Route('/occasiondetail{page}', name: 'app_second_hand_detail_page')]
    public function index(Request $request): Response
    {
        $scheduleModel = new Horaire;
        $schedules = $scheduleModel->findAll();

        if(isset($_SESSION) && !empty($_SESSION['Auth'])) {
            $auth = $_SESSION['Auth'];
        } else {
            $auth = '';
        }
        $routeParams = $request->attributes->get('_route_params');
        $vehiculeModel = new Vehicule;
        $vehicule = $vehiculeModel->find($routeParams['page']);

        $fuelModel = new Fuel;
        $fuel = $fuelModel->find($vehicule['fuelId']);
        $vehicule['fuel'] = $fuel['type'];

        $photoModel = new Photo;
        $photos = $photoModel->findBy(['vehiculeId' => $vehicule['id']]);
        $photo1 = $photos[0];
        unset($photos[0]);
        return $this->render('second_hand_detail_page/index.html.twig', [
            'auth' => $auth,
            'vehicule' => $vehicule,
            'photo1' => $photo1,
            'photos' => $photos,
            'schedules' => $schedules
        ]);
    }
}
