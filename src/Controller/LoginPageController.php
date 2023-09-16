<?php
namespace App\Controller;
session_start();

use App\Model\Admin;
use App\Model\Employe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginPageController extends AbstractController
{
    #[Route('/connexion', name: 'app_login_page')]
    public function index(): Response
    {
        if(isset($_SESSION) && !empty($_SESSION['Auth'])) {
            $auth = $_SESSION['Auth'];
        } else {
            $auth = '';
        }
        if(isset($_POST) && !empty($_POST)) {
            $admin = new Admin();
            $employee = new Employe;
            $email = $_POST['email'];
            $password = $_POST['password'];


            if($admin->findBy(['email' => $email]) !== []) {
      
              $adminToVerify = $admin->findBy(['email' => $email]);
      
              if(password_verify($password, $adminToVerify[0]['password'])) {
      
                $_SESSION['Auth'] = 'admin';
                header("location:./");
                exit();
              } else {
                echo '<script>alert(\'Mauvais identifiants\')</script>';
                return $this->render('/login_page/index.html.twig', [
                    'auth' => $auth,
                ]);
              }
            } else {
              echo '<script>alert(\'Mauvais identifiants\')</script>';
              return $this->render('/login_page/index.html.twig', [
                'auth' => $auth,
            ]);
            }
          } else {
            return $this->render('/login_page/index.html.twig', [
                'auth' => $auth,
            ]);
          }

        return $this->render('login_page/index.html.twig', [
            'auth' => $auth,
        ]);
    }
}
