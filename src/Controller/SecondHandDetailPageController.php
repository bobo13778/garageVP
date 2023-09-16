<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecondHandDetailPageController extends AbstractController
{
    #[Route('/second/hand/detail/page', name: 'app_second_hand_detail_page')]
    public function index(): Response
    {
        return $this->render('second_hand_detail_page/index.html.twig', [
            'controller_name' => 'SecondHandDetailPageController',
        ]);
    }
}
