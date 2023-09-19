<?php

namespace App\Controller;

use App\Model\Fuel;
use App\Model\Horaire;
use App\Model\Photo;
use App\Model\Temoignage;
use App\Model\Vehicule;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeePageController extends AbstractController
{
    //Affichage page
    #[Route('/employe', name: 'app_employee_page', methods:['GET'])]
    public function index(): Response
    {

        if(isset($_GET['testimonysent']) && $_GET['testimonysent']){
            echo'<script>alert(\'Le temoignage a bien été enregistré\')</script>';
        }
        if(isset($_GET['testimonydeleted']) && $_GET['testimonydeleted']){
            echo'<script>alert(\'Le temoignage a bien été supprimé\')</script>';
        }
        if(isset($_GET['testimonypublished']) && $_GET['testimonypublished']){
            echo'<script>alert(\'Le temoignage a bien été publié\')</script>';
        }

        $testimonyModel = new Temoignage;
        $testimonies = $testimonyModel->findAll();
        $vehiculeModel = new Vehicule;
        $vehicules = $vehiculeModel->findAll();
       
        $photoModel = new Photo;
        foreach($vehicules as $index => $vehicule){
              $mainPicture = $photoModel->find($vehicule['mainpictureId']);
              $vehicules[$index]['mainPicture'] = $mainPicture['src'];
        }

        $fuelModel = new Fuel;
        foreach($vehicules as $index => $vehicule){
            $fuel = $fuelModel->find($vehicule['fuelId']);
            $vehicules[$index]['fuel'] = $fuel['type'];
        }

        foreach($testimonies as $key => $testimony) {
            $testimonies[$key]['date'] = date("d/m/Y", strtotime($testimony['createdAt']));
            $testimonies[$key]['time'] = date("H:m", strtotime($testimony['createdAt']));
        }
        
        $scheduleModel = new Horaire;
        $schedules = $scheduleModel->findAll();


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
            'vehicules' => $vehicules,
            'schedules' => $schedules
         ]);
    }
    //gestion de la création d'un témoignage
    #[Route('/employe/submittestimony', name: 'app_employee_addtestimony_page', methods:['POST'])]
    public function newTestimony() : Response
    {   
        if(isset($_POST) && !empty($_POST)) {
            $testimony = new Temoignage();
            $testimony = $testimony->hydrate($_POST);
            $testimony->create($testimony);
            header("location:./?testimonysent=true");
            exit();

        }
        
        if(isset($_SESSION) && !empty($_SESSION['Auth'])) {
            $auth = $_SESSION['Auth'];
        } else {
            $auth = '';
        }

        return $this->render('employee_page/index.html.twig', [
            'auth' => $auth,
         ]);
    }
    //gestion de la suppression ou du refus d'un témoignage
    #[Route('/employe/deletetestimony', name: 'app_employee_deletetestimony_page', methods:['GET'])]
    public function deleteTestimony() : Response
    {   
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            $testimony = new Temoignage();
            $testimony = $testimony->delete($_GET['id']);
            header("location:./?testimonydeleted=true");
            exit();
        }
          
        if(isset($_SESSION) && !empty($_SESSION['Auth'])) {
            $auth = $_SESSION['Auth'];
        } else {
            $auth = '';
        }

        return $this->render('employee_page/index.html.twig', [
            'auth' => $auth,
         ]);
    }
    //gestion de la validation d'un témoignage
    #[Route('/employe/validatetestimony', name: 'app_employee_validatetestimony_page', methods:['GET'])]
    public function validateTestimony() : Response
    {   
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            $testimonyModel = new Temoignage();
            $testimonyDatas = $testimonyModel->find($_GET['id']);
            $testimony = $testimonyModel->hydrate($testimonyDatas);
            $testimony->setToValidate(false);
            $testimony->update($_GET['id'], $testimony);
            header("location:./?testimonypublished=true");
            exit();
        }
          
        if(isset($_SESSION) && !empty($_SESSION['Auth'])) {
            $auth = $_SESSION['Auth'];
        } else {
            $auth = '';
        }

        return $this->render('employee_page/index.html.twig', [
            'auth' => $auth,
         ]);
    }
}
