<?php

namespace App\Controller;

use App\Model\MessageContact;
use App\Model\Vehicule;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function PHPUnit\Framework\isEmpty;

class ContactPageController extends AbstractController
{   
    #[Route('/contact', name: 'app_contact_page', methods:['GET'])]
    public function index(): Response
    {   
        if(isset($_GET['sent']) && $_GET['sent']){
            echo'<script>alert(\'Merci pour votre message, nous y répondrons dans les plus brefs délais\')</script>';
        }

        if(isset($_GET['annonce'])) {
            $vehiculeModel = new Vehicule();
            $vehicule = $vehiculeModel->find($_GET['annonce']);
            $title = $vehicule['title'];
        } else {
            $title = 'simple';
        }

        if(isset($_SESSION) && !empty($_SESSION['Auth'])) {
            $auth = $_SESSION['Auth'];
        } else {
            $auth = '';
        }
        return $this->render('contact_page/index.html.twig', [
            'auth' => $auth,
            'title' => $title
        ]);
    }

    #[Route('/contact/submit', name: 'app_contact_page_post', methods:['POST'])]
    public function record() : Response
    {   
        if(isset($_POST) && !empty($_POST)) {
            $message = new MessageContact();
            $message = $message->hydrate($_POST);
            $message->create($message);
            header("location:./?sent=true");
            exit();

        }
        if(isset($_SESSION) && !empty($_SESSION['Auth'])) {
            $auth = $_SESSION['Auth'];
        } else {
            $auth = '';
        }
        $title = 'simple';

        return $this->render('contact_page/index.html.twig', [
            'auth' => $auth,
            'title' => $title
         ]);
    }
}
