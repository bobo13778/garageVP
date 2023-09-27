<?php

namespace App\Controller;
session_start();
use App\Model\Horaire;
use App\Model\Service;
use App\Model\Temoignage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'home', methods:['GET'])]
    public function index(): Response
    {   
        if(isset($_GET['sent']) && $_GET['sent']){
            echo'<script>alert(\'Merci pour votre temoignage\')</script>';
        }
        
        $serviceModel = new Service;
        $services = $serviceModel->findAll();
        $testimonyModel = new Temoignage;
        $testimonies = $testimonyModel->findAll();
        foreach($testimonies as $key => $testimony) {
            $testimonies[$key]['date'] = date("d/m/Y", $testimony['createdAt']);
            $testimonies[$key]['time'] = date("H:m", $testimony['createdAt']);
        }
        $scheduleModel = new Horaire;
        $schedules = $scheduleModel->findAll();

        if(isset($_SESSION) && !empty($_SESSION['Auth'])) {
            $auth = $_SESSION['Auth'];
        } else {
            $auth = '';
        }

        return $this->render('homepage/index.html.twig', [
            'services' => $services,
            'testimonies' => $testimonies,
            'auth' => $auth,
            'schedules' => $schedules
        ]);
    }

    #[Route('/submit', name: 'home_post', methods:['POST'])]
    public function record() : Response
    {   
        if(isset($_POST) && !empty($_POST)) {
            $testimony = new Temoignage();
            $testimony = $testimony->hydrate($_POST);
            $testimony->create($testimony);
            var_dump($_POST);
            header("location:./?sent=true");
            exit();

        }
        if(isset($_SESSION) && !empty($_SESSION['Auth'])) {
            $auth = $_SESSION['Auth'];
        } else {
            $auth = '';
        }

        return $this->render('homepage/index.html.twig', [
            'auth' => $auth
        ]);
    }
}
