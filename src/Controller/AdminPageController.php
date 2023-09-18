<?php

namespace App\Controller;

use App\Model\Employe;
use App\Model\Horaire;
use App\Model\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPageController extends AbstractController
{
    #[Route('/admin', name: 'app_admin_page')]
    public function index(): Response
    {
        $employeeModel = new Employe;
        $employees = $employeeModel->findAll();
        $serviceModel = new Service;
        $services = $serviceModel->findAll();
        $scheduleModel = new Horaire;
        $schedules = $scheduleModel->findAll();
        
        if(isset($_SESSION) && !empty($_SESSION['Auth'])) {
            $auth = $_SESSION['Auth'];
        } else {
            $auth = '';
        }
        if($auth !== 'admin') {
            header('location:./');
            exit();
        }
        return $this->render('admin_page/index.html.twig', [
            'auth' => $auth,
            'employees' => $employees,
            'services' => $services,
            'schedules' => $schedules
        ]);
    }
}
