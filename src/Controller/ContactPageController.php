<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactPageController extends AbstractController
{
    #[Route('/contact', name: 'app_contact_page')]
    public function index(): Response
    {
        if(isset($_SESSION) && !empty($_SESSION['Auth'])) {
            $auth = $_SESSION['Auth'];
        } else {
            $auth = '';
        }
        return $this->render('contact_page/index.html.twig', [
            'auth' => $auth,
        ]);
    }
}
