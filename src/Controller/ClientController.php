<?php

namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;




#[Route("/client1")]
class ClientController extends AbstractController
{
    #[Route("/info/{nom}", name:"client_info1")]
    function info($nom){
        $urlimg = $this->generateUrl('client_photo1', ['nom'=>$nom]);
        return new Response("Le prénom de $nom est Tintin <img src=\"$urlimg\"/>");
    }

    #[Route("/photo/{nom}", name:"client_photo1")]
    function photo($nom){
        return new BinaryFileResponse(__DIR__."/../../data/tintin.png");
    }

    #[Route("/prenom/{parametre}", name:"client_prenom1", requirements: ['parametre' => '[a-z]+(-[a-z]+)*'])]
    function prenom($parametre){
        $client = new Client();
        return $client->info($parametre);
    }
}
