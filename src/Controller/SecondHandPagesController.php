<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecondHandPagesController extends AbstractController
{
    #[Route('/occasions', name: 'app_second_hand_pages')]
    public function index(): Response
    {
        return $this->render('second_hand_pages/index.html.twig', [
            'controller_name' => 'SecondHandPagesController',
        ]);
    }
}
