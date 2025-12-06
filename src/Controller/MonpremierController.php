<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MonpremierController
{
    #[Route("/index")]
    public function maPremiereReponse()
    {
        $maReponse = new Response();

        $maReponse->setStatusCode(Response::HTTP_OK);
        $maReponse->headers->set('Content-Type', 'text/html');
        $maReponse->setContent("<html><title>Reponse</title><body>Résultat d'un objet reponse</body></html>");
        return $maReponse;
    }
}