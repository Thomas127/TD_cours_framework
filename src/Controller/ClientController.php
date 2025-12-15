<?php

namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


#[Route("/client")]
class ClientController extends AbstractController
{
    #[Route("/info/{nom}", name:"client_info")]
    function info($nom){
        
        return $this->render("monTemplate.html.twig", ['nom'=>$nom]);
    }

    #[Route("/photo/{nom}", name:"client_photo")]
    function photo($nom){
        return new BinaryFileResponse(__DIR__."/../../data/tintin.png");
    }

    #[Route("/affiche/{nom}", name:"client_affiche_photo")]
    function affiche_photo($nom){
        return $this->render("_affiche_photo.html.twig", ['nom' => $nom]);
    }
}
