<?php

namespace App\Controller;
session_start();
use App\Model\Horaire;
use App\Model\Photo;
use App\Model\Vehicule;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecondHandPagesController extends AbstractController
{
    #[Route('/occasions', name: 'app_second_hand_pages', methods:['GET'])]
    public function index(): Response
    {   

        $vehiculeModel = new Vehicule;
        $vehicules = $vehiculeModel->findAll();

        $photoModel = new Photo;
        foreach($vehicules as $index => $vehicule){
              $mainPicture = $photoModel->find($vehicule['mainpictureid']);
              $vehicules[$index]['mainpicture'] = $mainPicture['src'];
        }
        // gestion des filtres en ajax
        if(isset($_GET['filter'])) {

            $minMileageFilter = (int)$_GET['minMileageFilter'];
            $maxMileageFilter = (int)$_GET['maxMileageFilter'];
            $minPriceFilter = (int)$_GET['minPriceFilter'];
            $maxPriceFilter = (int)$_GET['maxPriceFilter'];
            $minYearFilter = (int)$_GET['minYearFilter'];
            $maxYearFilter = (int)$_GET['maxYearFilter'];

            $filteredVehicules = $vehicules;
            foreach($vehicules as $index => $vehicule) {
                if(
                    $vehicule['mileage'] < $minMileageFilter || $vehicule['mileage'] > $maxMileageFilter
                    || $vehicule['price'] < $minPriceFilter || $vehicule['mileage'] > $maxPriceFilter
                    || $vehicule['year'] < $minYearFilter || $vehicule['year'] > $maxYearFilter
                ) {
                    unset($filteredVehicules[$index]);
                }
            }

            return new JsonResponse([
                'filteredContent' => $this->renderView('second_hand_pages/_content.html.twig', [
                    'vehicules' => $filteredVehicules,
                ])
            ]);
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
