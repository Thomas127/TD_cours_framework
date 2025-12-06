<?php

namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class ClientController2 extends AbstractController
{
    function info($nom){
        $urlimg = $this->generateUrl('client_photo', ['nom'=>$nom]);
        return new Response("Le prénom de $nom est Tintin <img src=\"$urlimg\"/>");
    }

    function photo($nom){
        return new BinaryFileResponse(__DIR__."/../../data/tintin.png");
    }

    function prenom($parametre){
        $client = new Client();
        return $client->info($parametre);
    }
}
