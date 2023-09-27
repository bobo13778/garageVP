<?php

namespace App\Controller;
session_start();
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

        $photoModel = new Photo;
        $photos = $photoModel->findBy(['vehiculeid' => $vehicule['id']]);
        $photo1 = $photoModel->find($vehicule['mainpictureid']);
        foreach($photos as $index => $photo) {
            if($photo['id'] === $photo1['id']) {
               unset($photos[$index]);
            }
        }
        
        return $this->render('second_hand_detail_page/index.html.twig', [
            'auth' => $auth,
            'vehicule' => $vehicule,
            'photo1' => $photo1,
            'photos' => $photos,
            'schedules' => $schedules
        ]);
    }
}
