<?php

namespace App\Controller;
session_start();
use App\Model\Horaire;
use App\Model\Photo;
use App\Model\Temoignage;
use App\Model\Vehicule;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeePageController extends AbstractController
{
    //Page principale
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

        if(isset($_GET['vehiculecreated']) && $_GET['vehiculecreated']){
            echo'<script>alert(\'Nouvelle annonce enregistrée\')</script>';
        }
        if(isset($_GET['vehiculedeleted']) && $_GET['vehiculedeleted']){
            echo'<script>alert(\'Annonce supprimée\')</script>';
        }
        if(isset($_GET['vehiculemodified']) && $_GET['vehiculemodified']){
            echo'<script>alert(\'Annonce modifiée\')</script>';
        }

        $testimonyModel = new Temoignage;
        $testimonies = $testimonyModel->findAll();
        $vehiculeModel = new Vehicule;
        $vehicules = $vehiculeModel->findAll();
       
        $photoModel = new Photo;
        foreach($vehicules as $index => $vehicule){
              $mainPicture = $photoModel->find($vehicule['mainpictureid']);
              $vehicules[$index]['mainpicture'] = $mainPicture['src'];
        }
        $photos = $photoModel->findAll();

        foreach($vehicules as $index => $vehicule){
            $vehiculePhotos = $photoModel->findBy(['vehiculeid' => $vehicule['id']]);
            $vehicules[$index]['photos'] = $vehiculePhotos;
        }

        foreach($testimonies as $key => $testimony) {
            $testimonies[$key]['date'] = date("d/m/Y", $testimony['createdAt']);
            $testimonies[$key]['time'] = date("H:m", $testimony['createdAt']);
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
            'schedules' => $schedules,
            'photos' => $photos
         ]);
    }
//CRUD temoignages
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
        if($auth !== 'admin' && $auth !== 'employee') {
            header('location:./connexion');
            exit();
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
        if($auth !== 'admin' && $auth !== 'employee') {
            header('location:./connexion');
            exit();
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
        if($auth !== 'admin' && $auth !== 'employee') {
            header('location:./connexion');
            exit();
        }
        return $this->render('employee_page/index.html.twig', [
            'auth' => $auth,
         ]);
    }

//CRUD annonces

    //gestion de l'ajout d'une annonce
    #[Route('/employe/submitvehicule', name: 'app_employee_addvehicule_page', methods:['POST'])]
    public function newVehicule() : Response
    {   
        if(isset($_POST) && !empty($_POST)) {

//enregistrement de la photo dans le dossier annonces
            $mainpicturefilename = $_FILES['mainpicture']['tmp_name'];
            $nameToRegister = './Images/annonces/'.$_FILES['mainpicture']['name'];
            move_uploaded_file($mainpicturefilename, $nameToRegister);

//enregistrement de la photo dans la table photos
            substr($nameToRegister, 1, 0);
            $photoModel = new Photo;
            $mainpictureDb = $photoModel->hydrate(['src' => $nameToRegister]);
            $mainpictureDb->create($mainpictureDb);

//enregistrement de l'id de la photo dans $_POST
            $mainpicture = $photoModel->findBy(['src' => $nameToRegister]);
            $_POST['mainpictureid'] = $mainpicture[0]['id'];

//enregistrement de l'annonce dans la table vehicules
            $vehicule = new Vehicule;
            $vehicule = $vehicule->hydrate($_POST);
            $vehicule->create($vehicule);

            for ($index = 0; $index < count($_FILES['picture']['name']); $index++) {

//enregistrement des photos dans le dossier annonces

                $picturefilename = $_FILES['picture']['tmp_name'][$index];
                $picnameToRegister = './Images/annonces/'.$_FILES['picture']['name'][$index];
                move_uploaded_file($picturefilename, $picnameToRegister);

//enregistrement des photos dans la table photos avec l'id du véhicule
                substr($picnameToRegister, 1, 0);
                $vehiculeToAttach = $vehicule->findBy(['mainpictureid' => $_POST['mainpictureid'], ]);
                $picture = $photoModel->hydrate(['src' => $picnameToRegister, 'vehiculeid' => $vehiculeToAttach[0]['id']]);
                $picture->create($picture);
            }

            header("location:./?vehiculecreated=true");
            exit();

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

        ]);
    }

     //gestion de la suppression d'une annonce
     #[Route('/employe/deletevehicule', name: 'app_employee_deletevehicule_page', methods:['GET'])]
     public function deleteVehicule() : Response
     {   
         if(isset($_GET['id']) && !empty($_GET['id'])) {
             $vehiculeModel = new Vehicule();
             $vehiculeToDelete = $vehiculeModel->find($_GET['id']);

//supprime photos associées
            $pictureModel = new Photo;
            $picturesToDelete = $pictureModel->findBy(['vehiculeid' =>$vehiculeToDelete['id']]);
            foreach($picturesToDelete as $picture) {
                $pictureModel->delete($picture['id']);
            }

//supprime annonce
            $vehiculeModel->delete($_GET['id']);

//supprime mainpicture
            $pictureModel->delete($vehiculeToDelete['mainpictureid']);

            header("location:./?vehiculedeleted=true");
            exit();
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
 
         ]);
     }

      //gestion de la modification d'une annonce
      #[Route('/employe/modifyvehicule', name: 'app_employee_modifyvehicule_page', methods:['POST'])]
      public function modifyVehicule() : Response
      {   
        if(isset($_POST) && !empty($_POST)) {

            $idVehiculeToModify = (int)$_POST['idVehiculeToModify'];
            unset($_POST['idVehiculeToModify']);

            if(isset($_FILES['mainpicture']) && $_FILES['mainpicture']['tmp_name'] !== "") {
//enregistrement de la photo dans le dossier annonces
                $mainpicturefilename = $_FILES['mainpicture']['tmp_name'];
                $nameToRegister = './Images/annonces/'.$_FILES['mainpicture']['name'];
                move_uploaded_file($mainpicturefilename, $nameToRegister);

//enregistrement de la photo dans la table photos
                substr($nameToRegister, 1, 0);
                $photoModel = new Photo();
                $mainpictureDb = $photoModel->hydrate(['src' => $nameToRegister]);
                $mainpictureDb->create($mainpictureDb);

//enregistrement de l'id de la photo dans $_POST
                $mainpicture = $photoModel->findBy(['src' => $nameToRegister]);
                $_POST['mainpictureid'] = $mainpicture[0]['id'];
            } else unset($_POST['mainpictureid']);

//enregistrement des modifications de l'annonce
            $vehiculeModel = new Vehicule();
            $vehiculeDatas = $vehiculeModel->hydrate($_POST);
            $vehiculeModel->update($idVehiculeToModify, $vehiculeDatas);

            if(isset($_FILES['picture']) && $_FILES['picture']['tmp_name'][0] !== "") {
                for ($index = 0; $index < count($_FILES['picture']['name']); $index++) {

//enregistrement des photos dans le dossier annonces
                    $picturefilename = $_FILES['picture']['tmp_name'][$index];
                    $picnameToRegister = './Images/annonces/'.$_FILES['picture']['name'][$index];
                    move_uploaded_file($picturefilename, $picnameToRegister);

//enregistrement des photos dans la table photos avec l'id du véhicule
                    $photoModel = new Photo;
                    substr($picnameToRegister, 1, 0);
                    $picture = $photoModel->hydrate(['src' => $picnameToRegister, 'vehiculeid' => $idVehiculeToModify]);
                    $picture->create($picture);
                }
            }

//suppression des photos
            if(isset($_POST['pictureToDelete']) && !empty($_POST['pictureToDelete'])) {
                $pictureModel = new Photo();
                foreach($_POST['pictureToDelete'] as $pictureToDelete) {
                    $pictureModel->delete((int)$pictureToDelete);
                }
            }
            header("location:./?vehiculemodified=true");
            exit();
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
  
        ]);
      }
}
