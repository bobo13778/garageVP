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
        if(isset($_SESSION) && !empty($_SESSION['Auth'])) {
            $auth = $_SESSION['Auth'];
        } else {
            $auth = '';
        }
        return $this->render('second_hand_pages/index.html.twig', [
            'auth' => $auth,
        ]);
    }
}
