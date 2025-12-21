<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientController extends AbstractController
{
    #[Route("/client", name:"client", options: ['ouverture'=>'8-17'])]
    public function home(): Response
    {
        return new Response("Bienvenu sur le site");
    }

    public function ferme(): Response
    {
        return new Response("Le site n'est pas ouvert");
    }

}