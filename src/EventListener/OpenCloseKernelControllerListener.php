<?php

namespace App\EventListener;

use App\Controller\ClientController;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

class OpenCloseKernelControllerListener{
    private RouterInterface $router;

    public function __construct(RouterInterface $router){
        $this->router = $router;
    }

    public function add(ControllerEvent $event): void
    {
        $routeCollection = $this->router->getRouteCollection();
        $routename = $event->getRequest()->attributes->get('_route');
        
        if (!$routename) {
            return;
        }
        
        $route = $routeCollection->get($routename);
        
        if (!$route) {
            return;
        }

        $heureouverture = $route->getOption('ouverture');

        if (!$heureouverture) {
            return;
        }

        $heureserver = (int)date('G');
        $split_heures = explode('-', $heureouverture);
        $heure_ouvert = (int)$split_heures[0];
        $heure_fermer = (int)$split_heures[1];

        // Logique inversée : bloquer si HORS horaires
        if ($heureserver < $heure_ouvert || $heureserver >= $heure_fermer) {
            $event->setController([new ClientController(), 'ferme']);
        }
    }
}
