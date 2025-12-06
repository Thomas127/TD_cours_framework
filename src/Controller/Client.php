<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Client{
    
    function info($prenom){
        $list_client = [
            "paul" => ["nomfamille1", "nomfamille2"]
        ];

        if (isset($list_client[$prenom])){
            $noms = implode(" : ", $list_client[$prenom]);
            
            return new Response("Les clients ayant le prenom $prenom sont : $noms");
        }
        return new Response("Aucun clients ne portent ce prenom");
    }

}