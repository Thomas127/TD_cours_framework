<?php
// config/routes.php
use App\Controller\ClientController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routes): void {
    $routes->add('client_info1', 'client/info/{nom}')
        ->controller([ClientController::class, 'info'])
    ;

    $routes->add('client_photo1', 'client/photo/{nom}')
        ->controller([ClientController::class, 'photo'])
    ;

    $routes->add('client_prenom1', 'client/prenom/{parametre}')
        ->controller([ClientController::class, 'prenom'])
        ->requirements(['parametre' => '[a-z]+(-[a-z]+)*'])
    ;

};