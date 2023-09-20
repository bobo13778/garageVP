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
        if(isset($_GET['employeecreated']) && $_GET['employeecreated']) {
            echo'<script>alert(\'Employé enregistré\')</script>';
        }
        if(isset($_GET['employeedeleted']) && $_GET['employeedeleted']) {
            echo'<script>alert(\'Employé supprimé\')</script>';
        }
        if(isset($_GET['employeemodified']) && $_GET['employeemodified']) {
            echo'<script>alert(\'Employé modifié\')</script>';
        }

        if(isset($_GET['servicecreated']) && $_GET['servicecreated']) {
            echo'<script>alert(\'Service enregistré\')</script>';
        }
        if(isset($_GET['servicedeleted']) && $_GET['servicedeleted']) {
            echo'<script>alert(\'Service supprimé\')</script>';
        }
        if(isset($_GET['servicemodified']) && $_GET['servicemodified']) {
            echo'<script>alert(\'Service modifié\')</script>';
        }
        if(isset($_GET['scheduleemodified']) && $_GET['scheduleemodified']) {
            echo'<script>alert(\'Horaires modifiés\')</script>';
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
//CRUD employé

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
            if(!isset($_POST['moderator'])) {
                $_POST['moderator'] = '';
            }
            if(isset($_POST['password']) && $_POST['password'] === '') {
                unset($_POST['password']);
            }
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
//CRUD services
      //gestion de l'ajout d'un service
    #[Route('/admin/submitservice', name: 'app_admin_addservice_page', methods:['POST'])]
    public function newService() : Response
    {   
        if(isset($_POST) && !empty($_POST)) {
            $service = new Service();
            $filename = $_FILES['picture']['tmp_name'];
            $nameToRegister = './Images/services/'.$_FILES['picture']['name'];
            $_POST['picture'] = '/Images/services/'.$_FILES['picture']['name'];
            move_uploaded_file($filename, $nameToRegister);

            $service = $service->hydrate($_POST);
            $service->create($service);
            header("location:./?servicecreated=true");
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

     //gestion de la suppression d'un service
     #[Route('/admin/deleteservice', name: 'app_admin_deleteservice_page', methods:['GET'])]
     public function deleteService() : Response
     {   
         if(isset($_GET['id']) && !empty($_GET['id'])) {
             $service = new Service();
             $service = $service->delete($_GET['id']);
             header("location:./?servicedeleted=true");
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

      //gestion de la modification d'un service
      #[Route('/admin/modifyservice', name: 'app_admin_modifyservice_page', methods:['POST'])]
      public function modifyService() : Response
      {   
        if(isset($_POST) && !empty($_POST)) {

            $idServiceToModify = (int)$_POST['idServiceToModify'];
            unset($_POST['idServiceToModify']);
            $serviceModel = new Service();
            $filename = $_FILES['picture']['tmp_name'];
            $nameToRegister = './Images/services/'.$_FILES['picture']['name'];
            $_POST['picture'] = '/Images/services/'.$_FILES['picture']['name'];
            move_uploaded_file($filename, $nameToRegister);

            $serviceDatas = $serviceModel->hydrate($_POST);
            $serviceModel->update($idServiceToModify, $serviceDatas);
            header("location:./?servicemodified=true");
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

      //gestion de la modification des horaires
      #[Route('/admin/modifyschedule', name: 'app_admin_modifyschedule_page', methods:['POST'])]
      public function modifySchedule() : Response
      {   
        if(isset($_POST) && !empty($_POST)) {

            $scheduleModel = new Horaire();
            for($count=1; $count<8; $count++) {
                $datas = [
                    'day' => $_POST['day'.$count],
                    'morningStart' => date('H:i:s', strtotime($_POST['morningStart'.$count])),
                    'morningEnd' => date('H:i:s', strtotime($_POST['morningEnd'.$count])),
                    'afternoonStart' => date('H:i:s', strtotime($_POST['afternoonStart'.$count])),
                    'afternoonEnd' => date('H:i:s', strtotime($_POST['afternoonEnd'.$count]))
                ];
                if(isset($_POST['morningIsClosed'.$count])) {
                    $datas['morningIsClosed'] = $_POST['morningIsClosed'.$count];
                } else {
                    $datas['morningIsClosed'] = '';
                }
                if(isset($_POST['afternoonIsClosed'.$count])) {
                    $datas['afternoonIsClosed'] = $_POST['afternoonIsClosed'.$count];
                } else {
                    $datas['afternoonIsClosed'] = '';
                }
                $scheduleDatas = $scheduleModel->hydrate($datas);
                $scheduleModel->update($count, $scheduleDatas);
            }
            header("location:./?scheduleemodified=true");
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
