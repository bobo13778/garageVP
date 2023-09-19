<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DisconnectController extends AbstractController
{
    #[Route('/deconnexion', name: 'app_disconnect')]
    public function index(): Response
    {
      session_unset();
      session_destroy();
      header("location: ./");
      exit();
    }
}
