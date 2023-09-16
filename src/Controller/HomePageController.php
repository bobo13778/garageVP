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
        return $this->render('homepage/index.html.twig', [
            'services' => $services
        ]);
    }
}
