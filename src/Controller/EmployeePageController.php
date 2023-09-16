<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeePageController extends AbstractController
{
    #[Route('/employe', name: 'app_employee_page')]
    public function index(): Response
    {
        return $this->render('employee_page/index.html.twig', [
            'controller_name' => 'EmployeePageController',
        ]);
    }
}
