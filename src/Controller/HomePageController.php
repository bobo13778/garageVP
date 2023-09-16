<?php

namespace App\Controller;

use App\Model\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {   $serviceModel = new Service;
        $services = $serviceModel->findAll();
        if(isset($_SESSION) && !empty($_SESSION['Auth'])) {
            $auth = $_SESSION['Auth'];
        } else {
            $auth = '';
        }
        return $this->render('homepage/index.html.twig', [
            'services' => $services,
            'auth' => $auth
        ]);
    }
}
