<?php

namespace App\Controller;

use App\Model\Service;
use App\Model\Temoignage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {   $serviceModel = new Service;
        $services = $serviceModel->findAll();
        $testimonyModel = new Temoignage;
        $testimonies = $testimonyModel->findAll();
        foreach($testimonies as $key => $testimony) {
            $testimonies[$key]['date'] = date("d/m/Y", strtotime($testimony['createdAt']));
            $testimonies[$key]['time'] = date("H:m", strtotime($testimony['createdAt']));
        }
        if(isset($_SESSION) && !empty($_SESSION['Auth'])) {
            $auth = $_SESSION['Auth'];
        } else {
            $auth = '';
        }
        return $this->render('homepage/index.html.twig', [
            'services' => $services,
            'testimonies' => $testimonies,
            'auth' => $auth
        ]);
    }
}
