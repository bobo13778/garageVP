<?php

namespace App\Controller;

use App\Model\Temoignage;
use App\Model\Vehicule;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeePageController extends AbstractController
{
    #[Route('/employe', name: 'app_employee_page')]
    public function index(): Response
    {

        $testimonyModel = new Temoignage;
        $testimonies = $testimonyModel->findAll();
        $vehiculeModel = new Vehicule;
        $vehicules = $vehiculeModel->findAll();
        foreach($testimonies as $key => $testimony) {
            $testimonies[$key]['date'] = date("d/m/Y", strtotime($testimony['createdAt']));
            $testimonies[$key]['time'] = date("H:m", strtotime($testimony['createdAt']));
        }
        if(isset($_SESSION) && !empty($_SESSION['Auth'])) {
            $auth = $_SESSION['Auth'];
        } else {
            $auth = '';
        }
        if($auth !== 'admin' && $auth !== 'employee') {
            header('location:./connexion');
            exit();
        }
        return $this->render('employee_page/index.html.twig', [
            'auth' => $auth,
            'testimonies' => $testimonies,
            'vehicules' => $vehicules
         ]);
    }
}
