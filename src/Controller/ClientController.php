<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ClientController extends AbstractController
{
    #[Route("/client", name:"client", options: ['ouverture'=>'8-17'])]
    public function home(): Response
    {
        return new Response("Bonjour");
    }

    public function ferme(): Response
    {
        return new Response("Nous sommes fermés ! ");
    }
}