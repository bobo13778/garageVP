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
    //Page principale
    #[Route('/admin', name: 'app_admin_page', methods:['GET'])]
    public function index(): Response
    {
        if(isset($_GET['employeecreated']) && $_GET['employeecreated']){
            echo'<script>alert(\'L\'employé a bien été enregistré\')</script>';
        }
        if(isset($_GET['employeedeleted']) && $_GET['employeedeleted']){
            echo'<script>alert(\'L\'employé a bien été supprimé\')</script>';
        }
        if(isset($_GET['employeemodified']) && $_GET['employeemodified']){
            echo'<script>alert(\'L\'employé a bien été modifié\')</script>';
        }

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

    //gestion de l'ajout d'un employé
    #[Route('/admin/submitemployee', name: 'app_admin_addemployee_page', methods:['POST'])]
    public function newEmployee() : Response
    {   
        if(isset($_POST) && !empty($_POST)) {
            $employee = new Employe();
            $employee = $employee->hydrate($_POST);
            $employee->create($employee);
            header("location:./?employeecreated=true");
            exit();

        }
        
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

        ]);
    }

     //gestion de la suppression d'un employé
     #[Route('/admin/deleteemployee', name: 'app_admin_deleteemployee_page', methods:['GET'])]
     public function deleteEmployee() : Response
     {   
         if(isset($_GET['id']) && !empty($_GET['id'])) {
             $employee = new Employe();
             $employee = $employee->delete($_GET['id']);
             header("location:./?employeedeleted=true");
             exit();
 
         }
         
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
 
         ]);
     }

      //gestion de la modification d'un employé
      #[Route('/admin/modifyemployee', name: 'app_admin_modifyemployee_page', methods:['POST'])]
      public function modifyEmployee() : Response
      {   
        if(isset($_POST) && !empty($_POST)) {

            $idEmployeeToModify = (int)$_POST['idToModify'];
            unset($_POST['idToModify']);
            $employeeModel = new Employe();
            $employeeDatas = $employeeModel->hydrate($_POST);
            $employeeModel->update($idEmployeeToModify, $employeeDatas);
            header("location:./?employeemodified=true");
            exit();
  
          }
          
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
  
          ]);
      }
}
